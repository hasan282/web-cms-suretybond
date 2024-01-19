<?php

namespace App\Models;

use CodeIgniter\Model;

class tokenModel extends Model
{
    protected $DBGroup       = 'default';
    protected $table         = 'd_token';
    protected $allowedFields = ['email', 'token', 'created_at'];
}
