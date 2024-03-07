<?php
// $env=parse_ini_file(dirname(__DIR__)."/".".env");
// $_ENV['DB_HOST'] = $env['DB_HOST'];
// $_ENV['DB_USER'] = $env['DB_USER'];
// $_ENV['DB_PASS'] = $env['DB_PASS'];
// $_ENV['DB_NAME'] = $env['DB_NAME'];
// $_ENV['DB_PORT'] = $env['DB_PORT'];
if (!isset($_ENV['DB_HOST'])) {
    // If not set, read from .env file
    $env = parse_ini_file(dirname(__DIR__) . "/.env");
    $_ENV['DB_HOST'] = $env['DB_HOST'];
    $_ENV['DB_USER'] = $env['DB_USER'];
    $_ENV['DB_PASS'] = $env['DB_PASS'];
    $_ENV['DB_NAME'] = $env['DB_NAME'];
    $_ENV['DB_PORT'] = $env['DB_PORT'];
    $_ENV["JWT"]=$env["JWT"];
}


