<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\TransaksibaruModel;

class Transaksibaru extends BaseController
{
	
    protected $transaksibaruModel;
    protected $validation;
	
	public function __construct()
	{
	    $this->transaksibaruModel = new TransaksibaruModel();
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{

	    $data = [
                'controller'    	=> 'transaksibaru',
                'title'     		=> 'Transaksi'				
			];
		
		return view('transaksibaru', $data);
			
	}

	public function getAll()
	{
 		$response = $data['data'] = array();	

		$result = $this->transaksibaruModel->select()->findAll();
		
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
			
			$data = $this->transaksibaruModel->where('id' ,$id)->first();
			
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
$fields['bulan_tahun'] = $this->request->getPost('bulan_tahun');


        $this->validation->setRules([
			            'nomor' => ['label' => 'Nomor', 'rules' => 'required|min_length[0]|max_length[7]'],
            'tanggal' => ['label' => 'Tanggal', 'rules' => 'required|valid_date|min_length[0]'],
            'keterangan' => ['label' => 'Keterangan', 'rules' => 'required|min_length[0]'],
            'bulan_tahun' => ['label' => 'Bulan tahun', 'rules' => 'required|min_length[0]|max_length[4]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->transaksibaruModel->insert($fields)) {
												
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
$fields['nomor'] = $this->request->getPost('nomor');
$fields['tanggal'] = $this->request->getPost('tanggal');
$fields['keterangan'] = $this->request->getPost('keterangan');
$fields['bulan_tahun'] = $this->request->getPost('bulan_tahun');


        $this->validation->setRules([
			            'nomor' => ['label' => 'Nomor', 'rules' => 'required|min_length[0]|max_length[7]'],
            'tanggal' => ['label' => 'Tanggal', 'rules' => 'required|valid_date|min_length[0]'],
            'keterangan' => ['label' => 'Keterangan', 'rules' => 'required|min_length[0]'],
            'bulan_tahun' => ['label' => 'Bulan tahun', 'rules' => 'required|min_length[0]|max_length[4]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->transaksibaruModel->update($fields['id'], $fields)) {
				
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
		
			if ($this->transaksibaruModel->where('id', $id)->delete()) {
								
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
