<?php
// bootstrap.php

// Set session configuration
$sessionPath = __DIR__ . '/../sessions';
if (!is_dir($sessionPath)) {
    mkdir($sessionPath, 0777, true);
}

ini_set('session.save_path', $sessionPath);
ini_set('session.gc_maxlifetime', 1440); // Session max lifetime in seconds
ini_set('session.cookie_lifetime', 0); // Cookie lifetime, 0 means until the browser is closed

// Start the session
session_start();

require_once __DIR__ . '/../../autoload.php';

use Core\Auth;
use Core\Database;
use Core\Request;
use Core\Route;
use Core\View;

new Database();

$request = new Request();

new Auth();
require_once __DIR__ . '/../../routes/route.php';

Route::get('/api/documentation',function () {
    return view('swagger.index');
});

Route::dispatch($request->method, $request->path);
