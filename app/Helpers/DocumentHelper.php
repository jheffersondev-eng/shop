<?php

namespace App\Helpers;

class DocumentHelper
{
    /**
     * Remove all special characters from a string.
     * Keeps letters (unicode), numbers and spaces.
     *
     * @param string|null $value
     * @return string
     */
    public static function stripSpecialChars(?string $value): string
    {
        if ($value === null) {
            return '';
        }

        // Normalize unicode and remove control chars
        $value = trim($value);

        // Remove everything that is not a letter, number or space
        $clean = preg_replace('/[^\p{L}\p{N} ]+/u', '', $value);

        // Collapse multiple spaces
        $clean = preg_replace('/\s+/', ' ', $clean);

        return $clean;
    }

    /**
     * Format a CPF (11 digits) or CNPJ (14 digits).
     *
     * @param string|null $value
     * @return string
     */
    public static function formatCpfCnpj(?string $value): string
    {
        if ($value === null) {
            return '';
        }

        // Keep only digits
        $digits = preg_replace('/\D+/', '', $value);

        if (strlen($digits) === 11) {
            // CPF: 000.000.000-00
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $digits);
        }

        if (strlen($digits) === 14) {
            // CNPJ: 00.000.000/0000-00
            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $digits);
        }

        return $digits;
    }
}
