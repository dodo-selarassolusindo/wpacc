<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;
use CodeIgniter\Model;

class JurnalModel extends Model {

	protected $table = 'jurnal';
	protected $primaryKey = 'id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['nomor', 'tanggal', 'keterangan', 'bulan_tahun'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;

    function getNomor($tanggal)
    {
        if ($tanggal != null) {
            // echo pre(dateMysql($date)); exit;
        }

        $nextNomorJo = "";
        $lastNomorJo = "";

        $prefix = $tanggal != null ? substr($tanggal, 2, 2) . substr($tanggal, 5, 2) : date('ym'); // date('ym');
        $nextNomorJo = $prefix . "001";

        $q = "
            select
                nomor
            from
                ".$this->table."
            where
                left(nomor, 4) = '".$prefix."'
            order by
                nomor desc
            limit 1
        ";
        $row = $this->db->query($q)->getRow();

        if ($row) {
            $value = $row->nomor;
            if ($prefix == substr($value, 0, 4)) {
                /**
                 * masih pada bulan yang sama
                 */
                $lastNomorJo = intval(substr($value, 4, 3));
                $lastNomorJo = intval($lastNomorJo) + 1;
                $nextNomorJo = $prefix . sprintf('%03s', $lastNomorJo);
                if (strlen($nextNomorJo) > 7) {
                    $nextNomorJo = $prefix . "999";
                }
            }
        }
        return $nextNomorJo;
    }
}
