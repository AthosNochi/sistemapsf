<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Entities\User;
use App\Entities\Patient;
use App\Entities\Secretaria;
use App\Entities\Enfermeiro;
use App\Entities\Doctor;
use Validator;
use Redirect;
use Tests\TestCase;
use Stancl\Tenancy\Features\TenantRedirect;

class LoginController extends Controller
{

  public function __construct()
  {
    $this->middleware('patient');
    $this->middleware('enfermeiro');
    $this->middleware('secretaria');
    $this->middleware('doctor');
    $this->middleware('user');
  }

  public function index()
  {
    if(Auth::check()){
      if(Auth::user()['isAdm']){
        return redirect()->route('admin.dashboard');
      }elseif(Auth::patient()->tipo == 'paciente'){
        return redirect()->route('homepage-paciente');
      }elseif(Auth::secretaria()->tipo == 'secretaria'){
        return redirect()->route('homepage-secretaria');
      }elseif(Auth::enfermeiro()->tipo == 'enfermeiro'){
        return redirect()->route('homepage-enfermeiro');
      }elseif(Auth::doctor()->tipo == 'medico'){
        return redirect()->route('homepage-medico');
      }
    }
    return view('welcome');
  }


  public function login()
  {
    return view('welcome');
  }

  public function postLogin(Request $request)
  {
  //  dd($request->all());
      $validator = validator($request->all(),[
        'email'     => 'required|email|max:255|',
        'password'  => 'required|min:5|',
        ]);
        
        // dd($validator);
      
      if($validator->fails()){
        return redirect('/')
        ->withErrors($validator)
        ->withInput();

      }

      $credentials = ['email'=> $request->get('email') , 'password' => $request->get('password') ];
      $dados = ['email'=> $request->get('email') ];
      session(['credentials' => $credentials]);

      if(auth()->guard('patient')->attempt($credentials)) {
        return redirect('/homepage-paciente');
      }elseif(auth()->guard('user')->attempt($credentials)){
        return redirect('/user');
      }elseif(auth()->guard('secretaria')->attempt($credentials)){
         // $request->session()->put('secretaria_id', 'id');
        // \Session::put(['dados' => $dados]);
         //dd($dados);
         // dd($request->session()->all());
          return redirect('/homepage-Secretaria');
      }elseif(auth()->guard('enfermeiro')->attempt($credentials)){
            return redirect('/homepage-enfermeiro');
        }elseif(auth()->guard('doctor')->attempt($credentials)){
              return redirect('/homepage-medico');
        }else{
         // dd($credentials);
          return redirect('/')
          ->withErrors(['errors' => 'login inválido!']);
        }
  }

  public function logout()
  {
      if(auth()->guard('patient')->logout()){
        return redirect('/');
      }elseif(auth()->guard('user')->logout()){
        return redirect('/');
      }elseif(auth()->guard('secretaria')->logout()){
        return redirect('/');
      }elseif(auth()->guard('enfermeiro')->logout()){
        return redirect('/');
      }if(auth()->guard('doctor')->logout()){
        return redirect('/');
      }
  }
}