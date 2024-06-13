<?php
// src/Core/Route.php

namespace Core;

class Route
{
    protected static $routes = [];
    protected static $middleware = [];
    protected static $groupMiddleware = [];

    public static function get($path, $handler)
    {
        self::addRoute('GET', $path, $handler);
    }

    public static function post($path, $handler)
    {
        self::addRoute('POST', $path, $handler);
    }

    public static function put($path, $handler)
    {
        self::addRoute('PUT', $path, $handler);
    }

    public static function delete($path, $handler)
    {
        self::addRoute('DELETE', $path, $handler);
    }

    public static function middleware($middleware)
    {
        self::$middleware[] = $middleware;
        return new static;
    }

    protected static function addRoute($method, $path, $handler)
    {
        $middleware = array_merge(self::$middleware, self::$groupMiddleware);
        self::$routes[] = compact('method', 'path', 'handler', 'middleware');
    }

    public static function resource($path, $controller)
    {
        self::get("$path", [$controller, 'index']);
        self::get("$path/{id}", [$controller, 'show']);
        self::post("$path", [$controller, 'store']);
        self::put("$path/{id}", [$controller, 'update']);
        self::delete("$path/{id}", [$controller, 'destroy']);
    }

    public static function group($attributes, $callback)
    {
        if (isset($attributes['middleware'])) {
            self::$groupMiddleware[] = $attributes['middleware'];
        }

        call_user_func($callback);

        if (isset($attributes['middleware'])) {
            array_pop(self::$groupMiddleware);
        }
    }

    public static function redirect($from, $to, $status = 302)
    {
        $from = strpos($from, '/') !== 0 ? '/' . $from : $from;
        $to = strpos($to, '/') !== 0 ? '/' . $to : $to;

        http_response_code($status);
        header("Location: $to");
        exit;
    }

    public static function dispatch($method, $path)
    {
        $handler = null;
        $routeParams = [];
        $middleware = [];

        $pathParts = explode('?', $path);
        $pathWithoutParams = $pathParts[0];

        foreach (self::$routes as $route) {
            $routeParts = explode('?', $route['path']);
            $routePathWithoutParams = $routeParts[0];

            $pattern = str_replace('/', '\/', $routePathWithoutParams);
            $pattern = preg_replace('/\{([^}]+)\}/', '(?P<$1>[^\/]+)', $pattern);
            $pattern = '/^' . $pattern . '$/';

            if ($route['method'] === $method && preg_match($pattern, $pathWithoutParams, $matches)) {
                $handler = $route['handler'];
                $middleware = $route['middleware'];
                foreach ($matches as $key => $value) {
                    if (!is_numeric($key)) {
                        $routeParams[$key] = $value;
                    }
                }
                break;
            }
        }

        if ($handler === null) {
            http_response_code(404);
            echo "404 Not Found";
            exit;
        }

        foreach ($middleware as $middlewareClass) {
            $middlewareInstance = new $middlewareClass();
            $handler = $middlewareInstance->handle($handler);
        }

        $request = new Request();
        foreach ($routeParams as $key => $value) {
            $request->params[$key] = $value;
        }

        if ($method === 'PUT') {
            $inputData = self::parse_raw_http_request();
            $request->params = array_merge($request->params, $inputData);
        }

        if (is_array($handler) && count($handler) == 2 && is_string($handler[0]) && is_string($handler[1])) {
            $class = $handler[0];
            $method = $handler[1];
            $controller = new $class();
            return call_user_func_array([$controller, $method], [$request]);
        } elseif (is_callable($handler)) {
            return $handler($request);
        }

        http_response_code(500);
        echo "500 Internal Server Error";
        exit;
    }

    protected static function parse_raw_http_request()
    {
        $input = file_get_contents('php://input');
        $a_data = [];
    
        // Check if it's JSON
        if (strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
            $a_data = json_decode($input, true);
        }
        // Check if it's multipart/form-data
        else if (strpos($_SERVER['CONTENT_TYPE'], 'multipart/form-data') !== false) {
            // Grab multipart boundary
            preg_match('/boundary=(.*)$/', $_SERVER['CONTENT_TYPE'], $matches);
            $boundary = $matches[1];
    
            // Split the content by boundary and get rid of the last -- element
            $a_blocks = preg_split("/-+$boundary/", $input);
            array_pop($a_blocks);
    
            // Loop data blocks
            foreach ($a_blocks as $id => $block) {
                if (empty($block)) {
                    continue;
                }
    
                // Parse uploaded files
                if (strpos($block, 'filename=') !== false) {
                    preg_match("/name=\"([^\"]*)\"; filename=\"([^\"]*)\"\r\nContent-Type: ([^\r\n]+)\r\n\r\n(.*)$/s", $block, $matches);
                    if (isset($matches[4])) {
                        $filename = $matches[2];
                        $filedata = $matches[4];
    
                        // Save file to desired location
                        $target_dir = public_path('');  // Use public_path function
                        if (!is_dir($target_dir)) {
                            mkdir($target_dir, 0755, true);
                        }
                        $target_file = $target_dir . basename($filename);
                        file_put_contents($target_file, $filedata);
    
                        // Add file path to data array
                        $a_data[$matches[1]] = $target_file;
                    }
                }
                // Parse all other fields
                else {
                    preg_match('/name=\"([^\"]*)\"[\r\n]+([\s\S]*)?$/', $block, $matches);
                    if (!empty($matches)) {
                        $key = trim($matches[1]);
                        $value = isset($matches[2]) ? trim($matches[2]) : '';
                        $a_data[$key] = $value;
                    }
                }
            }
        }
        // Fallback to parse_str if it's a regular URL encoded form
        else {
            parse_str($input, $a_data);
        }
    
        return $a_data;
    }   

}
