<?php
// src/Core/Middleware/AuthMiddleware.php

namespace App\Middleware;

use Core\Auth;
use Core\Request;
use Core\Response;

class AuthApiMiddleware
{
    public function handle($handler)
    {
        return function (Request $request) use ($handler) {
            if ($this->isAuthenticated()) {
                return call_func($handler, $request);
            } else {
                echo(Response::json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ]));
                exit;
            }
        };
    }


    protected function isAuthenticated()
    {
        return Auth::check();
    }
}
