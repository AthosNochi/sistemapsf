<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\DoctorCreateRequest;
use App\Http\Requests\DoctorUpdateRequest;
use App\Repositories\DoctorRepository;
use App\Validators\DoctorValidator;
use App\Services\DoctorService;
use App\Entities\Doctor;
use Illuminate\Support\Facades\Hash;

/**
 * Class DoctorsController.
 *
 * @package namespace App\Http\Controllers;
 */
class DoctorsController extends Controller
{
    /**
     * @var DoctorRepository
     */
    protected $repository;

    /**
     * @var DoctorValidator
     */
    protected $validator;

    /**
     * DoctorsController constructor.
     *
     * @param DoctorRepository $repository
     * @param DoctorValidator $validator
     */
    public function __construct(DoctorRepository $repository, DoctorValidator $validator, DoctorService $service)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service      = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = $this->repository->all();
        return view('doctor.index')->with([
            'doctors'=>$doctors,
        ]);
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DoctorCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(DoctorCreateRequest $request)
    {
       
        Doctor::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'tipo'  => $request['tipo'],
            'cpf'   => $request['cpf'],
            'rg'    => $request['rg'],
            'phone' => $request['phone'],
            'specialty' => $request['specialty'],
            'crm' => $request['crm'],
            'password' =>$request['password'],
        ]);
        
        $request->session()->flash('status', 'Task was successful!');
        
        return redirect()->route('doctor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $doctor,
            ]);
        }

        return view('doctors.show', compact('doctor'));
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
        $doctor = $this->repository->find($id);

        return view('doctors.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DoctorUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(DoctorUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $doctor = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Doctor updated.',
                'data'    => $doctor->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Doctor deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Doctor deleted.');
    }
}
