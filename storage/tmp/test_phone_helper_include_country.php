<?php
require __DIR__ . '/../../vendor/autoload.php';

use App\Helpers\PhoneHelper;

$examples = [
    '79 99641-6903',
    '+55 79 99641-6903',
    '11999998888',
    '99999999',
];

foreach ($examples as $ex) {
    echo "Original: " . var_export($ex, true) . PHP_EOL;
    echo "Format (no country): " . PhoneHelper::format($ex) . PHP_EOL;
    echo "Format (include country): " . PhoneHelper::format($ex, true) . PHP_EOL;
    echo str_repeat('-', 40) . PHP_EOL;
}
