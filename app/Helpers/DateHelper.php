<?php

namespace App\Helpers;

class DateHelper
{
    /**
     * Format a value for an HTML date input (YYYY-MM-DD) or return empty string.
     * Accepts strings, DateTimeInterface or null.
     */
    public static function formatForInput($value): string
    {
        if (is_null($value)) {
            return '';
        }

        if ($value instanceof \DateTimeInterface) {
            return $value->format('Y-m-d');
        }

        // If it's a numeric timestamp
        if (is_numeric($value)) {
            return date('Y-m-d', (int) $value);
        }

        // Try to parse string date
        try {
            $dt = new \DateTime($value);
            return $dt->format('Y-m-d');
        } catch (\Throwable $e) {
            return '';
        }
    }
}
