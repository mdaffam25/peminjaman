<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nama','NIM','no_telp','password'];

    public function getByNIM($nim)
    {
        return $this->where('NIM', $nim)->first();
    }
}
