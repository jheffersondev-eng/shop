<?php
require __DIR__ . '/../../vendor/autoload.php';
$app = require __DIR__ . '/../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$id = \App\Models\User::orderBy('id')->value('id');
echo $id ?: 'NULL';
