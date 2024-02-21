<?php

namespace App\Validation;

use CodeIgniter\Validation\Rules;

class ValidationRules extends Rules
{
    public function is_exist(string $str, string $fields, array $data): bool
    {
        $db = \Config\Database::connect();
        [$table, $column] = explode('.', $fields);
        $count = $db->table($table)->where($column, $str)->countAllResults();

        return $count > 0;
    }
}

?>