<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PsfCreateRequest;
use App\Http\Requests\PsfUpdateRequest;
use App\Repositories\PsfRepository;
use App\Validators\PsfValidator;
use App\Services\PsfService;
use App\Entities\Psf;

/**
 * Class PsfsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PsfsController extends Controller
{
    protected $repository;
    protected $validator;
    protected $service;

    public function __construct(PsfRepository $repository, PsfValidator $validator, PsfService $service)
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
        $psfs = $this->repository->all();
        return view('psfs.index')->with([
            'psfs'=>$psfs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PsfCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PsfCreateRequest $request)
    {
        //$request    = $this->service->store($request->all());//
        $psf        = $request ['success'] ? $request['data'] : null;
        $psf        = Psf::create($request->all());
        
        session()->flash('success', [
            'success'  => $request['success'],
            'messages' => $request['messages']
        ]);
        
        return redirect()->route('psf.index');
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
        $psf = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $psf,
            ]);
        }

        return view('psfs.show', compact('psf'));
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
        $psf = $this->repository->find($id);

        return view('psfs.edit', compact('psf'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PsfUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PsfUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $psf = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Psf updated.',
                'data'    => $psf->toArray(),
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
                'message' => 'Psf deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Psf deleted.');
    }
}
