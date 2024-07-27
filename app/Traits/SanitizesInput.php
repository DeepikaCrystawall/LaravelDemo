<?php

namespace App\Traits;

trait SanitizesInput
{
    /**
     * Sanitize a given input by replacing special characters with spaces.
     *
     * @param  string  $input
     * @return string
     */
    protected function sanitizeInput($input)
    {
        return preg_replace('/[^a-zA-Z0-9\s]/', ' ', $input);
    }

    /**
     * Sanitize input fields in an array.
     *
     * @param  array  $fields
     * @return array
     */
    protected function sanitizeInputFields(array $fields)
    {
        foreach ($fields as &$field) {
            $field = $this->sanitizeInput($field);
        }
        return $fields;
    }
}
