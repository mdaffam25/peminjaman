<?php

namespace App\Validation;

class CustomRules
{
    public function is_not_past_date(string $str): bool
    {
        return strtotime($str) >= strtotime(date('Y-m-d'));
    }
}
