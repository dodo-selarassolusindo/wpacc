<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\JurnalModel;
use App\Models\AkunModel;
use App\Models\JurnaldetailModel;

class Jurnal extends BaseController
{

    protected $jurnalModel;
    protected $validation;
    protected $akunModel;
    protected $jurnaldetailModel;

	public function __construct()
	{
	    $this->jurnalModel = new JurnalModel();
       	$this->validation =  \Config\Services::validation();
		$this->akunModel = new AkunModel();
        $this->jurnaldetailModel = new JurnaldetailModel();
	}

	public function getNomor($tanggal = null)
    {
        // echo $this->t30joborderModel->getNomorJo(date('d-m-Y'));
        $tanggal = $tanggal == null ? date('Y-m-d') : $tanggal;
        return $this->jurnalModel->getNomor($tanggal);
    }

	public function index()
	{

	    $data = [
            'controller' => 'jurnal',
            'title' => 'Jurnal',
			'nomor' => $this->jurnalModel->getNomor(date('Y-m-d')),
			'dataAkun' => $this->akunModel->findAll(),
		];

		return view('jurnal', $data);

	}

	public function getAll()
	{
 		$response = $data['data'] = array();

		$result = $this->jurnalModel->select()->findAll();

		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group">';
			$ops .= '<button type="button" class=" btn btn-sm dropdown-toggle btn-info" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
			$ops .= '<i class="fa-solid fa-pen-square"></i>  </button>';
			$ops .= '<div class="dropdown-menu">';
			$ops .= '<a class="dropdown-item text-info" onClick="save('. $value->id .')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '<a class="dropdown-item text-orange" ><i class="fa-solid fa-copy"></i>   ' .  lang("App.copy")  . '</a>';
			$ops .= '<div class="dropdown-divider"></div>';
			$ops .= '<a class="dropdown-item text-danger" onClick="remove('. $value->id .')"><i class="fa-solid fa-trash"></i>   ' .  lang("App.delete")  . '</a>';
			$ops .= '</div></div>';

			$data['data'][$key] = array(
				$value->nomor,
$value->tanggal,
$value->keterangan,

				$ops
			);
		}

		return $this->response->setJSON($data);
	}

	public function getOne()
	{
 		$response = array();

		$id = $this->request->getPost('id');

		if ($this->validation->check($id, 'required|numeric')) {

			// $data = $this->jurnalModel->where('id' ,$id)->first();
            $data['jurnal'] = $this->jurnalModel->where('id' ,$id)->first();
            $data['jurnal_detail'] = $this->jurnaldetailModel->where('jurnal', $id)->findAll();

			return $this->response->setJSON($data);

		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}

	}

	public function add()
	{
        $response = array();

		$fields['id'] = $this->request->getPost('id');
$fields['nomor'] = $this->request->getPost('nomor');
$fields['tanggal'] = $this->request->getPost('tanggal');
$fields['keterangan'] = $this->request->getPost('keterangan');
$fields['bulan_tahun'] = substr($this->request->getPost('tanggal'), 5, 2) . substr($this->request->getPost('tanggal'), 2, 2);


        $this->validation->setRules([
			            'nomor' => ['label' => 'Nomor', 'rules' => 'required|min_length[0]|max_length[7]'],
            'tanggal' => ['label' => 'Tanggal', 'rules' => 'required|valid_date|min_length[0]'],
            'keterangan' => ['label' => 'Keterangan', 'rules' => 'required|min_length[0]'],
            'bulan_tahun' => ['label' => 'Bulan & Tahun', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->jurnalModel->insert($fields)) {

                $response['success'] = true;
                $response['messages'] = lang("App.insert-success") ;

                // ambil id data master jurnal terbaru
                $jurnal = $this->jurnalModel->getInsertID();

                // insert data detail jurnal
                $data = $this->request->getPost();
                foreach ($data['akun'] as $key => $item) {
                    $detail = [
                        'jurnal' => $jurnal,
                        'akun' => $item,
                        'debet' => $data['debet'][$key],
                        'kredit' => $data['kredit'][$key],
                    ];
                    $this->jurnaldetailModel->insert($detail);
                }

            } else {

                $response['success'] = false;
                $response['messages'] = lang("App.insert-error") ;

            }
        }

        return $this->response->setJSON($response);
	}

	public function edit()
	{
        $response = array();

		$fields['id'] = $this->request->getPost('id');
$fields['nomor'] = $this->request->getPost('nomor');
$fields['tanggal'] = $this->request->getPost('tanggal');
$fields['keterangan'] = $this->request->getPost('keterangan');
$fields['bulan_tahun'] = $this->request->getPost('bulan_tahun');


        $this->validation->setRules([
			            'nomor' => ['label' => 'Nomor', 'rules' => 'required|min_length[0]|max_length[7]'],
            'tanggal' => ['label' => 'Tanggal', 'rules' => 'required|valid_date|min_length[0]'],
            'keterangan' => ['label' => 'Keterangan', 'rules' => 'required|min_length[0]'],
            'bulan_tahun' => ['label' => 'Bulan & Tahun', 'rules' => 'permit_empty|min_length[0]|max_length[4]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->jurnalModel->update($fields['id'], $fields)) {

                $response['success'] = true;
                $response['messages'] = lang("App.update-success");

            } else {

                $response['success'] = false;
                $response['messages'] = lang("App.update-error");

            }
        }

        return $this->response->setJSON($response);
	}

	public function remove()
	{
		$response = array();

		$id = $this->request->getPost('id');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();

		} else {

			if ($this->jurnalModel->where('id', $id)->delete()) {

				$response['success'] = true;
				$response['messages'] = lang("App.delete-success");

			} else {

				$response['success'] = false;
				$response['messages'] = lang("App.delete-error");

			}
		}

        return $this->response->setJSON($response);
	}

}
