<?php

namespace App\Models;

use CodeIgniter\Model;

class DynamicModel extends Model
{
    protected $table;       // Table name will be set dynamically
    protected $primaryKey;  // Primary key will be set dynamically
    protected $allowedFields; // Fields that can be inserted/updated

    public function setTableConfig(string $table, string $primaryKey, array $allowedFields)
    {
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->allowedFields = $allowedFields;
    }
}
