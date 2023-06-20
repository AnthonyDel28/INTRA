<?php

if (!function_exists('truncateString')) {
    /**
     * Truncate a string while preserving HTML tags and entities.
     *
     * @param string $string The input string.
     * @param int $limit The maximum length of the string.
     * @param string $end The string to append at the end if it exceeds the limit.
     * @return string The truncated string.
     */
    function truncateString($string, $limit, $end = '...')
    {
        $decoded = htmlspecialchars_decode($string); // Decode HTML entities
        $trimmed = mb_substr($decoded, 0, $limit, 'UTF-8'); // Truncate the string
        $stripped = strip_tags($trimmed); // Remove any remaining tags
        $encoded = htmlspecialchars($stripped, ENT_QUOTES, 'UTF-8'); // Encode HTML entities
        return $encoded . (mb_strlen($decoded, 'UTF-8') > $limit ? $end : '');
    }
}
