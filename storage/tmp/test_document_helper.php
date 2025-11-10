<?php
require __DIR__ . '/../../vendor/autoload.php';

use App\Helpers\DocumentHelper;

$examples = [
    "Rua da Rosa, nº 123 - Apt #5!",
    "J@o D'oe!",
    "064.360.155-40",
    "12345678909",
    "11222333000181",
    null,
];

foreach ($examples as $ex) {
    echo "Original: " . var_export($ex, true) . PHP_EOL;
    echo "Strip: " . DocumentHelper::stripSpecialChars($ex) . PHP_EOL;
    echo "Format CPF/CNPJ: " . DocumentHelper::formatCpfCnpj($ex) . PHP_EOL;
    echo str_repeat('-', 40) . PHP_EOL;
}
