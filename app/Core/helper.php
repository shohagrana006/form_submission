<?php


if (!function_exists('view')) {
    function view(string $path, array $data = []): void
    {
        extract($data);
        include_once ROOT_PATH . '/views/' . $path . '.php';
    }
}

if (!function_exists('env')) {
    function env(string $key, $default = null)
    {
        $envFilePath = ROOT_PATH . '/.env';
        if (!file_exists($envFilePath)) {
            return $default;
        }
        $env = parse_ini_file($envFilePath);
        return isset($env[$key]) ? $env[$key] : $default;
    }
}

if (!function_exists('custom_path')) {
    function custom_path(): array
    {
        $custom['basePath'] = dirname($_SERVER['SCRIPT_NAME']);
        if (!isset($_SERVER['REQUEST_SCHEME'])) {
            $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        } else {
            $custom['scheme'] = $_SERVER['REQUEST_SCHEME'];
        }

        return $custom;
    }
}

if (!function_exists('asset')) {
    function asset(string $path): void
    {
        $scheme = custom_path()['scheme'];
        $basePath = custom_path()['basePath'];
        echo $scheme . '://' . $_SERVER['HTTP_HOST'] . $basePath . '/' . 'public' . '/' . $path;
    }
}

if (!function_exists('url')) {
    function url($input = '')
    {
        $scheme = custom_path()['scheme'];
        $basePath = custom_path()['basePath'];
        $base = ($basePath !== '/') ? $basePath : '';

        echo rtrim($scheme . '://' . $_SERVER['HTTP_HOST'] . $base . '/' . ltrim($input, '/'), '/');
    }
}
