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

// Init autoloader setup from Composer
if (!include_once(__DIR__.'/vendor/autoload.php'))
{
    die('Have you run composer over this project yet ?');
}

// Setup Cilex
$app = new \Cilex\Application('A little adventure of code', '1.0');

// Registering Commands
$app->command(new \CommonLedger\Jobs\SoftwareEngineer\Commands\GetToken());

// TODO: Now write this class and make it send the token to us
$app->command(new \CommonLedger\Jobs\SoftwareEngineer\Commands\SendToken());

// Not run in strict (review it in strict)

$app->run();