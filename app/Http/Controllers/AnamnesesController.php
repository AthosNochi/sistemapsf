<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AnamneseCreateRequest;
use App\Http\Requests\AnamneseUpdateRequest;
use App\Repositories\AnamneseRepository;
use App\Validators\AnamneseValidator;
use App\Entities\Anamnese;
use App\Entities\Patient;
use App\Repositories\PatientRepository;

/**
 * Class AnamnesesController.
 *
 * @package namespace App\Http\Controllers;
 */
class AnamnesesController extends Controller
{
    protected $repository;
    protected $patientRepository;
    protected $validator;

    /**
     * AnamnesesController constructor.
     *
     * @param AnamneseRepository $repository
     * @param AnamneseValidator $validator
     */
    public function __construct(AnamneseRepository $repository, AnamneseValidator $validator, PatientRepository $patientRepository)
    {
        $this->repository           = $repository;
        $this->validator            = $validator;
        $this->patientRepository    = $patientRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $anamneses          = $this->repository->all();
        $anamnese           = Anamnese::all();
        $patient_list       = $this->patientRepository->selectBoxList();
        
        //dd( $agendamentos );
        

        return view('secretaria.homepage', [
            'anamneses'         => $anamneses,
            'patient_list'      => $patient_list,
        ]);
    }

    //////-------HOMEPAGE-SECRETARIA------------//////

    public function homepageSecretaria(){;
        $anamneses          = $this->repository->all();
        $patient_list       = $this->patientRepository->selectBoxList();
        
        //dd($horarios );
        return view('secretaria.homepage', [
            'anamneses'         => $anamneses,
            'patient_list'      => $patient_list,
        ]);
    }

    //////-------HOMEPAGE-ENFERMEIRO------------//////

    public function homepageEnfermeiro(){;
        $anamneses          = $this->repository->all();
        $patient_list       = $this->patientRepository->selectBoxList();
        
        //dd($horarios );
        return view('enfermeiro.homepage', [
            'anamneses'         => $anamneses,
            'patient_list'      => $patient_list,
        ]);
    }

    //////-------HOMEPAGE-MEDICO------------//////
    public function homepageMedico(){;
        $anamneses          = $this->repository->all();
        $patient_list       = $this->patientRepository->selectBoxList();
        
        //dd($horarios );
        return view('doctor.homepage', [
            'anamneses'         => $anamneses,
            'patient_list'      => $patient_list,
        ]);
    }

    public function create()
    {
        $method         = 'post';
        $anamnese       = new Anamnese();
        $patients       = Patient::all();

        return view('secretaria.homepage')  ->with('patients', $patients)
                                            ->with('method', $method)
                                            ->with('anamnese', $anamnese);
    }

    public function novaAnamnese(){
        $anamneses          = $this->repository->all();
        $patient_list       = $this->patientRepository->selectBoxList();
        
        //dd($horarios );
        return view('secretaria.nova-anamnese', [
            'anamneses'         => $anamneses,
            'patient_list'      => $patient_list,
        ]);
    }

    public function novaAnamneseEnfermeiro(){
        $anamneses          = $this->repository->all();
        $patient_list       = $this->patientRepository->selectBoxList();
        
        //dd($horarios );
        return view('enfermeiro.nova-anamnese', [
            'anamneses'         => $anamneses,
            'patient_list'      => $patient_list,
        ]);
    }

    public function novaAnamneseMedico(){
        $anamneses          = $this->repository->all();
        $patient_list       = $this->patientRepository->selectBoxList();
        
        //dd($horarios );
        return view('doctor.nova-anamnese', [
            'anamneses'         => $anamneses,
            'patient_list'      => $patient_list,
        ]);
    }


    public function store(AnamneseCreateRequest $request)
    {

        
        $anamnese                       = new Anamnese();
        
        $anamnese->name                 = $request->input('id_patient');
        $anamnese->gender               = $request->input('gender');
        $anamnese->age                  = $request->input('age');
        $anamnese->corEtnia             = $request->input('corEtnia');
        $anamnese->estadoCivil          = $request->input('estadoCivil');
        $anamnese->profissao            = $request->input('profissao');
        $anamnese->naturalidade         = $request->input('naturalidade');
        $anamnese->address              = $request->input('address');
        $anamnese->nomeMae              = $request->input('nomeMae');
        $anamnese->religiao             = $request->input('religiao');
        $anamnese->alergias             = $request->input('alergias');
        $anamnese->queixaPrincipal      = $request->input('queixaPrincipal');
        $anamnese->historicoDoenca      = $request->input('historicoDoenca');
        $anamnese->sintomas             = $request->input('sintomas');
        $anamnese->secretaria_id        = $request->input('secretaria_id');
        

        $anamnese->save();

        return back();
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
        $anamnese = $this->repository->find($id);
        $anamneses          = $this->repository->all();
        $patient_list       = $this->patientRepository->selectBoxList();

        //dd($anamnese);

        return view('anamneses.show', [
            'anamnese' => $anamnese,
            'anamneses' => $anamneses,
            'patient_list' => $patient_list
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
        $anamnese = $this->repository->find($id);
        $anamneses          = $this->repository->all();
        $patient_list= $this->patientRepository->selectBoxList();

        return view('anamneses.edit', [
            'anamnese' => $anamnese,
            'anamneses' => $anamneses,
            'patient_list' => $patient_list

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AnamneseUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AnamneseUpdateRequest $request, $id)
    {
        $anamnese = $this->repository->find($id);
        $anamneses          = $this->repository->all();
        $patient_list= $this->patientRepository->selectBoxList();

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $anamnese = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Anamnese updated.',
                'data'    => $anamnese->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return view('anamneses.show', [
                'anamneses' => $anamneses,
                'patient_list' => $patient_list
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Anamnese deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Anamnese deleted.');
    }
}
