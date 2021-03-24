<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(BASE_URL);

/**
 * Controllers
 */
$router->namespace("Source\Controllers");

/**
 * Web
 */
$router->group(null);
$router->get("/", "ResumeController:create");
$router->post("/store", "ResumeController:store");

/**
 * Resumes
 */
$router->group('resumes');


$router->dispatch();