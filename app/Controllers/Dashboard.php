<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'controller'    => 'dashboard',
            'title'         => 'Dashboard'
		];
        return view('dashboard', $data);
    }
}
