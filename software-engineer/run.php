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

// TODO: Now write this class to send us your email to our API (docs: http://www.commonledger.com/job/github/software-engineer)
$app->command(new \CommonLedger\Jobs\SoftwareEngineer\Commands\GetToken());

// This class works, and sends us your code that you wrote so we can see how you approached things
$app->command(new \CommonLedger\Jobs\SoftwareEngineer\Commands\SendToken());

$app->run();