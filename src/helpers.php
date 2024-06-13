<?php
// src/helpers.php

use Core\RedirectResponse;
use Core\View;

function view($viewName, $data = [])
{
    $viewPath = __DIR__ . '/../views';
    $view = new View($viewPath);
    $view->render($viewName, $data);
}

function MsgPage($errorMessage, $code = 500)
{
    http_response_code($code); // Atur status kode untuk kesalahan server internal
    include __DIR__ . '/core/template/error.php'; // Ganti dengan lokasi template error yang sesuai
}


if (!function_exists('redirect')) {
    function redirect($path)
    {
        return new RedirectResponse($path);
    }
}

function call_func($handler, $request)
{
    if (is_array($handler) && count($handler) == 2 && is_string($handler[0]) && is_string($handler[1])) {
        $class = $handler[0];
        $method = $handler[1];
        $controller = new $class();
        return call_user_func_array([$controller, $method], [$request]);
    } elseif (is_callable($handler)) {
        return $handler($request);
    }
}

if (!function_exists('storage_path')) {
    function storage_path($path = '')
    {
        $storagePath = __DIR__ . '\..\storage';

        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $fullPath = $path ? $storagePath . DIRECTORY_SEPARATOR . $path : $storagePath;

        if ($path && !is_dir($fullPath)) {
            mkdir($fullPath, 0755, true);
        }

        return $fullPath;
    }
}

if (!function_exists('public_path')) {
    function public_path($path = '')
    {
        $publicPath = __DIR__ . '\..\public';

        if (!is_dir($publicPath)) {
            mkdir($publicPath, 0755, true);
        }

        $fullPath = $path ? $publicPath . DIRECTORY_SEPARATOR . $path : $publicPath;

        if ($path && !is_dir($fullPath)) {
            mkdir($fullPath, 0755, true);
        }

        return $fullPath;
    }
}

function getBaseDomain()
{
    // Mengambil skema (http atau https)
    $scheme = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http';

    // Mengambil host
    $host = $_SERVER['HTTP_HOST'];

    // Menggabungkan skema dan host untuk membentuk base domain
    return $scheme . '://' . $host;
}

function sendRequest($method, $url, $data = null, $token = null)
{
    // Tentukan base domain jika URL relatif
    $base_domain = getBaseDomain();

    // Cek apakah URL sudah lengkap atau hanya path
    if (!preg_match("/^http(s)?:\\/\\//", $url)) {
        $url = rtrim($base_domain, '/') . '/' . ltrim($url, '/');
    }

    // echo($url);

    // Inisialisasi CURL
    $curl = curl_init();

    // Atur URL target API
    curl_setopt($curl, CURLOPT_URL, $url);

    // Atur metode permintaan
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, strtoupper($method));

    // Jika ada data yang dikirim (untuk POST dan PUT)
    if ($data !== null) {
        $data_string = json_encode($data);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $headers = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
        );
    } else {
        $headers = array(
            'Content-Type: application/json'
        );
    }

    // Tambahkan header untuk token jika ada
    if ($token !== null) {
        $headers[] = 'Authorization: Bearer ' . $token;
    }

    // Atur opsi lainnya
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Eksekusi CURL dan simpan respons
    $response = curl_exec($curl);

    // Periksa jika terjadi kesalahan CURL
    if ($response === false) {
        $error = curl_error($curl);
        curl_close($curl);
        return "Error: " . $error;
    } else {
        // Tutup CURL
        curl_close($curl);
        return $response;
    }
}

function redirect($path, $sessionData = [])
{
    // Atur header redirect
    header("Location: " . getBaseDomain() . $path);

    // Simpan data sesi jika diberikan
    foreach ($sessionData as $key => $value) {
        $_SESSION[$key] = $value;
    }

    // Keluar dari skrip
    exit;
}

use Core\Auth;

function auth_check()
{
    // Periksa status otentikasi pengguna
    if (!Auth::check()) {
        // Jika pengguna belum terotentikasi, arahkan ke halaman login
        header('Location: /login');
        exit;
    }
}