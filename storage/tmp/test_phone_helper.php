<?php
require __DIR__ . '/../../vendor/autoload.php';

use App\Helpers\PhoneHelper;

$examples = [
    '+55 (11) 99999-8888',
    '11 99999 8888',
    '(11) 98888-7777',
    '988887777',
    '88887777',
    '5511988887777',
    null,
    '12345'
];

foreach ($examples as $ex) {
    echo "Original: " . var_export($ex, true) . PHP_EOL;
    echo "Normalize: " . PhoneHelper::normalize($ex) . PHP_EOL;
    echo "Format: " . PhoneHelper::format($ex) . PHP_EOL;
    echo "Components: "; var_export(PhoneHelper::extractComponents($ex)); echo PHP_EOL;
    echo "Is mobile: " . (PhoneHelper::isMobile($ex) ? 'yes' : 'no') . PHP_EOL;
    echo str_repeat('-', 40) . PHP_EOL;
}
