<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EnfermeiroCreateRequest;
use App\Http\Requests\EnfermeiroUpdateRequest;
use App\Repositories\EnfermeiroRepository;
use App\Validators\EnfermeiroValidator;
use App\Services\EnfermeiroService;
use App\Entities\Enfermeiro;
use Illuminate\Support\Facades\Hash;

/**
 * Class EnfermeirosController.
 *
 * @package namespace App\Http\Controllers;
 */
class EnfermeirosController extends Controller
{
    protected $service;
    protected $repository;
     
    public function __construct(EnfermeiroRepository $repository, EnfermeiroService $service)
    {
        $this->repository   = $repository;
        $this->service      = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $enfermeiros = $this->repository->all();
        return view('enfermeiro.index')->with([
            'enfermeiros'=>$enfermeiros,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(EnfermeiroCreateRequest $request)
    {
        Enfermeiro::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'tipo'  => $request['tipo'],
            'cpf'   => $request['cpf'],
            'phone' => $request['phone'],
            'password' => $request['password'],
        ]);
        
        $request->session()->flash('status', 'Task was successful!');
        
        return redirect()->route('enfermeiro.index');
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
        $enfermeiro = $this->repository->find($id);
        
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $enfermeiro,
            ]);
        }

        return view('enfermeiros.show', compact('enfermeiro'));
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
        $enfermeiro = $this->repository->find($id);

        return view('enfermeiros.edit', compact('enfermeiro'));
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
    public function update(EnfermeiroUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $enfermeiro = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'User updated.',
                'data'    => $enfermeiro->toArray(),
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
        $request = $this->service->destroy($id);

        session()->flash('success', [
            'success'  => $request['success'],
            'messages' => $request['messages']
        ]);
        
        return redirect()->route('enfermeiro.index');
    }
}
