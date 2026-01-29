<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table            = 'student';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = ['appl_no', 'username', 'name', 'gender', 'dob', 'religion', 'nationality', 'blood_group', 'aadhar', 'class', 'session', 'section', 'mobile', 'address', 'trust_id', 'school_id', 'status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = ['addStudentUsername'];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function addStudentUsername(array $data)
    {
        if (isset($data['id'])) {
            $studentId = rand(100,999).$data['id'];
            $username = 'STU' . str_pad($studentId, 5, '0', STR_PAD_LEFT);
            $db      = \Config\Database::connect();
            $builder = $db->table($this->table);
            $builder->where('id', $data['id'])
                    ->update(['username' => $username]);
        }
        return $data;
    }
}
