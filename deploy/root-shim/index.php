<?php

/**
 * Auto-copied to project root by deploy.yml.
 * Needed because Enhance docroot points to project root instead of /public.
 * The permanent fix is to change the Enhance Web Root to /public and delete
 * these files + the copy step.
 */

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = __DIR__.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/vendor/autoload.php';

/** @var Application $app */
$app = require_once __DIR__.'/bootstrap/app.php';

$app->handleRequest(Request::capture());
