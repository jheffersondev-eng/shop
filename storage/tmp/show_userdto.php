<?php
require __DIR__ . '/../../vendor/autoload.php';

use App\Http\Dto\User\UserDto;

$d = new UserDto('brenaa@porto-shop.com', 'secret', true);
echo json_encode($d->toArray(), JSON_PRETTY_PRINT) . PHP_EOL;
