#!/usr/bin/env php
<?php


// Add PHP "Strict Mode"
error_reporting( E_ALL ^ E_NOTICE ^ E_STRICT );

// Set CWD to the same directory as this file
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__) . "/../");
chdir(dirname(__FILE__) . "/../");

// No, no, no, go away
ini_set('session.use_cookies', '0');
ini_set('magic_quotes_gpc','off');
ini_set('magic_quotes_runtime','off');

// Setup autoloader setup from Composer
if (!include_once(__DIR__.'/vendor/autoload.php'))
{
    die('You must set up the project dependencies.');
}

// Setup Cilex
$app = new \Cilex\Application('I\'m broken, FIX ME!');

// Register a configuration file
$app->register(new \Cilex\Provider\ConfigServiceProvider(), array('config.path' => "./config"));

//
$app->command(new \CommonLedger\Jobs\SoftwareEngineer\Commands\HelloWorldCommand());

$app->run();