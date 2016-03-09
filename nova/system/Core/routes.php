<?php
/**
 * Routes - all standard routes are defined here.
 *
 * @author David Carr - dave@daveismyname.com
 * @version 3.0
 * @date updated March 9th, 2016
 */

/** Create alias for Router. */
use Core\Router;
use Helpers\Hooks;
use Helpers\Response;

/** Get the Router instance. */
$router = Router::getInstance();

/** Define static routes. */

// Default Routing
Router::any('', 'App\Controllers\Welcome@index');
Router::any('subpage', 'App\Controllers\Welcome@subPage');
Router::any('admin/(:any)(/(:any))(/(:any))(/(:any))', 'App\Controllers\Demo@test');
/** End default routes */

/** Do not remove - route for resources css / js files path is relative to app directory */
Router::get('resource/(:all)', function ($path) {
    Response::serveFile(APPDIR.$path);
});

/** Module routes. */
$hooks = Hooks::get();
$hooks->run('routes');
/** End Module routes. */

/** If no route found. */
Router::error('Core\Error@index');

/** Execute matched routes. */
$router->dispatch();