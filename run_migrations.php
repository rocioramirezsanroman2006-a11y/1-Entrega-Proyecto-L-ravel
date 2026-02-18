<?php

// Set up the application
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

// Get Laravel container
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Run migrations
echo "Running migrations...\n";
$kernel->call('migrate', ['--force' => true]);

// Run seeder
echo "\nRunning RoleSeeder...\n";
$kernel->call('db:seed', ['--class' => 'RoleSeeder', '--force' => true]);

echo "\nDone!\n";
