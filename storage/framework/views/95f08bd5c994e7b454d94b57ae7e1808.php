<?php ($seo = $seo ?? app(\App\Services\Contracts\SeoServiceInterface::class)->toArray()); ?>
<title><?php echo e($seo['title']); ?></title>
<meta name="description" content="<?php echo e($seo['description']); ?>">
<link rel="canonical" href="<?php echo e($seo['canonical']); ?>">

<meta property="og:title" content="<?php echo e($seo['title']); ?>">
<meta property="og:description" content="<?php echo e($seo['description']); ?>">
<meta property="og:image" content="<?php echo e($seo['image']); ?>">
<meta property="og:url" content="<?php echo e($seo['canonical']); ?>">
<meta property="og:type" content="<?php echo e($seo['type']); ?>">
<meta property="og:locale" content="<?php echo e($seo['locale']); ?>">
<meta property="og:site_name" content="<?php echo e($seo['site_name']); ?>">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo e($seo['title']); ?>">
<meta name="twitter:description" content="<?php echo e($seo['description']); ?>">
<meta name="twitter:image" content="<?php echo e($seo['image']); ?>">

<link rel="alternate" hreflang="ar" href="<?php echo e(url('/ar' . request()->getRequestUri())); ?>">
<link rel="alternate" hreflang="en" href="<?php echo e(url('/en' . request()->getRequestUri())); ?>">

<meta name="theme-color" content="#C8102E">
<?php /**PATH D:\laragon\www\mi\mi-poultry-cms\mi-poultry-cms\resources\views/partials/seo-meta.blade.php ENDPATH**/ ?>