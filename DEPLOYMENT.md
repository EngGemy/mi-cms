# Deployment Guide

## Production server requirements

- Ubuntu 22.04+ / Debian 12+ / Rocky 9+
- PHP 8.3 with extensions: `bcmath`, `ctype`, `curl`, `fileinfo`, `gd` (or `imagick`), `intl`, `mbstring`, `mysql`, `openssl`, `pdo`, `tokenizer`, `xml`, `zip`
- Nginx 1.22+ or Apache 2.4+
- MySQL 8 / MariaDB 10.6+ / PostgreSQL 14+
- Node 20+ (for asset build only; can be done on CI)
- Redis (recommended for cache & queue)
- Supervisor (for queue worker & scheduler)

## Step-by-step

### 1. Clone & install

```bash
cd /var/www
git clone <repo> mi-poultry
cd mi-poultry
composer install --no-dev --optimize-autoloader
npm ci && npm run build
```

### 2. Environment

```bash
cp .env.example .env
nano .env
```

Set:
```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://mi-poultry.com
DB_*=...
CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis
MAIL_MAILER=smtp
MAIL_HOST=...
```

```bash
php artisan key:generate
```

### 3. Database

```bash
php artisan migrate --force
php artisan db:seed --class=UserSeeder
# Content seeders are optional in prod — usually you edit via admin
```

### 4. Storage

```bash
php artisan storage:link
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

### 5. Cache optimization

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
php artisan filament:optimize
```

(Rerun after every deploy.)

### 6. Queue worker (for emails, etc.)

`/etc/supervisor/conf.d/mi-queue.conf`:
```ini
[program:mi-queue]
command=php /var/www/mi-poultry/artisan queue:work redis --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=2
```

```bash
sudo supervisorctl reread && supervisorctl update
```

### 7. Scheduler (for sitemap regeneration)

`crontab -e -u www-data`:
```
* * * * * cd /var/www/mi-poultry && php artisan schedule:run >> /dev/null 2>&1
```

### 8. Nginx config

```nginx
server {
    listen 443 ssl http2;
    server_name mi-poultry.com www.mi-poultry.com;
    root /var/www/mi-poultry/public;
    index index.php;

    ssl_certificate /etc/letsencrypt/live/mi-poultry.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/mi-poultry.com/privkey.pem;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    add_header Referrer-Policy "strict-origin-when-cross-origin";

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    # Aggressive caching for built assets
    location ~* \.(?:ico|css|js|gif|jpe?g|png|webp|svg|woff2?)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
}
```

### 9. SSL

```bash
sudo certbot --nginx -d mi-poultry.com -d www.mi-poultry.com
```

### 10. Opcache (php.ini)

```ini
opcache.enable=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=20000
opcache.validate_timestamps=0  ; production only
```

## Continuous deployment

Recommended GitHub Actions workflow:
1. SSH into server
2. `git pull`
3. `composer install --no-dev --optimize-autoloader`
4. `npm ci && npm run build`
5. `php artisan migrate --force`
6. `php artisan optimize`
7. `php artisan filament:optimize`
8. `sudo supervisorctl restart mi-queue:*`

## Image storage on S3 (optional)

Edit `config/filesystems.php` or `.env`:
```
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=...
AWS_SECRET_ACCESS_KEY=...
AWS_DEFAULT_REGION=eu-central-1
AWS_BUCKET=mi-poultry-media
AWS_USE_PATH_STYLE_ENDPOINT=false
```

The `spatie/laravel-medialibrary` config picks this up automatically.

## Monitoring

- Laravel Telescope for dev (`composer require laravel/telescope --dev`)
- Sentry for production errors
- New Relic / Datadog for APM

