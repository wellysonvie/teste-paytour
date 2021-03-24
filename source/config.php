<?php

define("DEBUG", false);

define("BASE_URL", "https://localhost/teste-paytour");

define("APP", "Enviar CV");

define("DATA_LAYER_CONFIG", [
    "driver" => "pgsql",
    "host" => getenv("DB_HOST"),
    "port" => "5432",
    "dbname" => getenv("DB_DATABASE"),
    "username" => getenv("DB_USER"),
    "passwd" => getenv("DB_PASSWORD"),
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

define("CONF_MAIL_SMTP", [
    "host" => getenv("SMTP_HOST"),
    "port" => "587",
    "user" => getenv("SMTP_USER"),
    "passwd" => getenv("SMTP_PASSWORD"),
    "from_name" => getenv("SMTP_FROM_NAME"),
    "from_email" => getenv("SMTP_FROM_EMAIL"),
]);

if (!DEBUG) {
    ini_set('display_errors', 0);
    error_reporting(0);
}

/* 
* HELPERS
*/

function url($uri = null, $params = [])
{
    $urlParams = !empty($params) ? '?' . http_build_query($params) : '';

    if ($uri) {
        return BASE_URL . "/{$uri}" . $urlParams;
    }
    return BASE_URL . $urlParams;
}

function view($view, $data = [], $scripts = [], $styles = [])
{
    foreach ($data as $key => $value) {
        $$key = $value;
    }

    include __DIR__ . "/../theme/Views/template.php";
}

function dd($data)
{
    var_dump($data);
    die;
}

function alert($msg, $type = 'info')
{
    $_SESSION['msg'] = $msg;
    $_SESSION['status'] = $type;
}
