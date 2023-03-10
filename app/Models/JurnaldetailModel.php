<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;
use CodeIgniter\Model;

class JurnaldetailModel extends Model {
    
	protected $table = 'jurnal_detail';
	protected $primaryKey = 'id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['jurnal', 'akun', 'debet', 'kredit'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}