<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    

    public function homepageSecretaria(){
        return view ('secretaria.homepage');
    }

    public function homepageEnfermeiro(){
        return view ('enfermeiro.homepage');
    }

    public function homepageMedico(){
        return view ('doctor.homepage');
    }

    public function homepagePaciente(){
        return view ('patient.homepage');
    } 

    public function dadosPaciente(){
        return view('patient.dados');
    }
}
