<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load the maintenance view or output the coming soon message.
| Otherwise we will continue with booting the application.
*/

if (
    file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')
) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to require it into the script here so that
| we don't have to worry about the loading of any classes manually.
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Include The Compiled Class File
|--------------------------------------------------------------------------
|
| Include the compiled class file. The compiled file provides a significant
| speed increase to all class loading operations that your application
| utilizes.
*/

$compiledPath = __DIR__.'/../bootstrap/cache/packages.php';

if (file_exists($compiledPath)) {
    require $compiledPath;
}

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's router, and send the associated response back to
| the client allowing them to enjoy the creative and beautiful
| application we have prepared for them.
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();