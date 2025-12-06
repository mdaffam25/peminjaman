<?php

namespace App\Models;
use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'NIM';
    protected $allowedFields = ['NIM','password'];

    public function getByNIM($nim)
    {
        return $this->where('NIM', $nim)->first();
    }
}
