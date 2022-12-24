<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\AkunModel;

class Akun extends BaseController
{
	
    protected $akunModel;
    protected $validation;
	
	public function __construct()
	{
	    $this->akunModel = new AkunModel();
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{

	    $data = [
                'controller'    	=> 'akun',
                'title'     		=> 'Akun'				
			];
		
		return view('akun', $data);
			
	}

	public function getAll()
	{
 		$response = $data['data'] = array();	

		$result = $this->akunModel->select()->findAll();
		
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
				$value->grup_akun,
$value->kode,
$value->nama,
$value->debet_lalu,
$value->kredit_lalu,
$value->debet_ini,
$value->kredit_ini,
$value->bulan_tahun,

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
			
			$data = $this->akunModel->where('id' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}	
		
	}	

	public function add()
	{
        $response = array();

		$fields['id'] = $this->request->getPost('id');
$fields['grup_akun'] = $this->request->getPost('grup_akun');
$fields['kode'] = $this->request->getPost('kode');
$fields['nama'] = $this->request->getPost('nama');
$fields['debet_lalu'] = $this->request->getPost('debet_lalu');
$fields['kredit_lalu'] = $this->request->getPost('kredit_lalu');
$fields['debet_ini'] = $this->request->getPost('debet_ini');
$fields['kredit_ini'] = $this->request->getPost('kredit_ini');
$fields['bulan_tahun'] = $this->request->getPost('bulan_tahun');


        $this->validation->setRules([
			            'grup_akun' => ['label' => 'Grup Akun', 'rules' => 'required|min_length[0]|max_length[11]'],
            'kode' => ['label' => 'Kode', 'rules' => 'required|min_length[0]|max_length[4]'],
            'nama' => ['label' => 'Nama', 'rules' => 'required|min_length[0]|max_length[50]'],
            'debet_lalu' => ['label' => 'Debet Bulan Lalu', 'rules' => 'required|numeric|min_length[0]'],
            'kredit_lalu' => ['label' => 'Kredit Bulan Lalu', 'rules' => 'required|numeric|min_length[0]'],
            'debet_ini' => ['label' => 'Debet Bulan Ini', 'rules' => 'required|numeric|min_length[0]'],
            'kredit_ini' => ['label' => 'Kredit Bulan Ini', 'rules' => 'required|numeric|min_length[0]'],
            'bulan_tahun' => ['label' => 'Bulan & Tahun', 'rules' => 'required|min_length[0]|max_length[4]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->akunModel->insert($fields)) {
												
                $response['success'] = true;
                $response['messages'] = lang("App.insert-success") ;	
				
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
$fields['grup_akun'] = $this->request->getPost('grup_akun');
$fields['kode'] = $this->request->getPost('kode');
$fields['nama'] = $this->request->getPost('nama');
$fields['debet_lalu'] = $this->request->getPost('debet_lalu');
$fields['kredit_lalu'] = $this->request->getPost('kredit_lalu');
$fields['debet_ini'] = $this->request->getPost('debet_ini');
$fields['kredit_ini'] = $this->request->getPost('kredit_ini');
$fields['bulan_tahun'] = $this->request->getPost('bulan_tahun');


        $this->validation->setRules([
			            'grup_akun' => ['label' => 'Grup Akun', 'rules' => 'required|min_length[0]|max_length[11]'],
            'kode' => ['label' => 'Kode', 'rules' => 'required|min_length[0]|max_length[4]'],
            'nama' => ['label' => 'Nama', 'rules' => 'required|min_length[0]|max_length[50]'],
            'debet_lalu' => ['label' => 'Debet Bulan Lalu', 'rules' => 'required|numeric|min_length[0]'],
            'kredit_lalu' => ['label' => 'Kredit Bulan Lalu', 'rules' => 'required|numeric|min_length[0]'],
            'debet_ini' => ['label' => 'Debet Bulan Ini', 'rules' => 'required|numeric|min_length[0]'],
            'kredit_ini' => ['label' => 'Kredit Bulan Ini', 'rules' => 'required|numeric|min_length[0]'],
            'bulan_tahun' => ['label' => 'Bulan & Tahun', 'rules' => 'required|min_length[0]|max_length[4]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->akunModel->update($fields['id'], $fields)) {
				
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
		
			if ($this->akunModel->where('id', $id)->delete()) {
								
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
