<?php

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// if environment is development, then show all erros
if (getenv('APP_ENV') == 'development') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

// Composer autoloading
if (file_exists('./vendor/autoload.php')) {
    $loader = include './vendor/autoload.php';
}

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
