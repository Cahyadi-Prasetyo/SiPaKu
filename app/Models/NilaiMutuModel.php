<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiMutuModel extends Model
{
    protected $table = 'nilai_mutu';
    protected $primaryKey = 'nilai_huruf';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'nilai_huruf',
        'nilai_mutu'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Get nilai mutu by nilai huruf
     */
    public function getNilaiMutu($nilaiHuruf)
    {
        $result = $this->find($nilaiHuruf);
        return $result ? $result['nilai_mutu'] : 0.00;
    }

    /**
     * Get all nilai mutu as associative array
     */
    public function getAllAsArray()
    {
        $data = $this->findAll();
        $result = [];
        foreach ($data as $item) {
            $result[$item['nilai_huruf']] = $item['nilai_mutu'];
        }
        return $result;
    }
}
