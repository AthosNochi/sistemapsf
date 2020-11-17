<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SecretariaCreateRequest;
use App\Http\Requests\SecretariaUpdateRequest;
use App\Repositories\SecretariaRepository;
use App\Validators\SecretariaValidator;
use App\Services\SecretariaService;
use App\Entities\Secretaria;
use Illuminate\Support\Facades\Hash;

/**
 * Class SecretariasController.
 *
 * @package namespace App\Http\Controllers;
 */
class SecretariasController extends Controller
{
    

    protected $repository;
    protected $validator;
    protected $service;

    public function __construct(SecretariaRepository $repository, SecretariaValidator $validator, SecretariaService $service)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service    = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $secretarias = $this->repository->all();
        return view('secretaria.index')->with([
            'secretarias'=>$secretarias,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SecretariaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SecretariaCreateRequest $request)
    {
        //$request    = $this->service->store($request->all());//
        Secretaria::create([
            'name' => $request['name'],
            'cpf' => $request['cpf'],
            'rg' => $request['rg'],
            'email' => $request['email'],
            'tipo'  => $request['tipo'],
            'password'=> $request['password']
            ]);

            $request->session()->flash('status', 'Task was successful!');
        
        return redirect()->route('secretaria.index');
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request , $id)
    {
        $value = $request->session()->get('key');
        $secretaria = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $secretaria,
            ]);
        }

        return view('secretarias.show', compact('secretaria'));
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
        $secretaria = $this->repository->find($id);

        return view('secretarias.edit', compact('secretaria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SecretariaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SecretariaUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $secretaria = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'secretaria updated.',
                'data'    => $secretaria->toArray(),
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
}

