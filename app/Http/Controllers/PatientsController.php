<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PatientCreateRequest;
use App\Http\Requests\PatientUpdateRequest;
use App\Repositories\PatientRepository;
use App\Repositories\AgendamentoRepository;
use App\Validators\PatientValidator;
use App\Services\PatientService;
use App\Entities\Patient;
use Illuminate\Support\Facades\Hash;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class PatientsController extends Controller
{
    
    protected $service;
    protected $repository;
    protected $validator;
     
    public function __construct(PatientRepository $repository, PatientService $service, PatientValidator $validator)
    {
        $this->repository   = $repository;
        $this->service      = $service;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $patients = $this->repository->all();
        return view('patient.index')->with([
            'patients'=>$patients,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PatientCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PatientCreateRequest $request)
    {
        //$request = $this->service->store($request->all());//
        Patient::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'tipo'  => $request['tipo'],
            'cpf'   => $request['cpf'],
            'rg'    => $request['rg'],
            'birth' => $request['birth'],
            'gender'=> $request['gender'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'sus'   => $request['sus'],
            'notes' => $request['notes'],
            'password' => Hash::make($request['password']),
        ]);
        
        $request->session()->flash('status', 'Task was successful!');
        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function novoPaciente(){
        $patients = $this->repository->all();
        return view('secretaria.novo-paciente')->with([
            'patients'=>$patients,
        ]);
    }

    public function show()
    {
        $patients = $this->repository->all();
        return view('patient.show')->with([
            'patients'=>$patients,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = $this->repository->find($id);

        return view('patient.edit', compact('patient'));
    }

    public function editar($id)
    {
        $patient = $this->repository->find($id);

        return view('patient.editP');
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  PatientUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PatientUpdateRequest $request, $id)
    {
        $patient            = $this->repository->find($id);
        $patients           = $this->repository->all();
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $patient = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'User updated.',
                'data'    => $patient->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return view('patient.show', [
                'patients' => $patients,
            ]);

        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = $this->service->destroy($id);

        session()->flash('success', [
            'success'  => $request['success'],
            'messages' => $request['messages']
        ]);
        
        return redirect()->route('patient.index');
    }
}
