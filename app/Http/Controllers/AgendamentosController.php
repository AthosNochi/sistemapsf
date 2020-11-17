<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AgendamentoCreateRequest;
use App\Http\Requests\AgendamentoUpdateRequest;
use App\Repositories\AgendamentoRepository;
use App\Repositories\PatientRepository;
use App\Repositories\DoctorRepository;
use App\Repositories\SecretariaRepository;
use App\Validators\AgendamentoValidator;
use App\Services\AgendamentoService;
use App\Entities\Agendamento;
use App\Entities\Patient;
use App\Entities\Doctor;
use App\Entities\Secretaria;
use Carbon\Carbon;
use Auth;


/**
 * Class AgendamentosController.
 *
 * @package namespace App\Http\Controllers;
 */
class AgendamentosController extends Controller
{
    /**
     * @var AgendamentoRepository
     */
    protected $repository;
    protected $validator;
    protected $service;
    protected $patientRepository;
    protected $doctorRepository;
    protected $secretariaRepository;

    /**
     * AgendamentosController constructor.
     *
     * @param AgendamentoRepository $repository
     * @param AgendamentoValidator $validator
     */
    public function __construct(AgendamentoRepository $repository, AgendamentoValidator $validator, AgendamentoService $service, PatientRepository $patientRepository, DoctorRepository $doctorRepository, SecretariaRepository $secretariaRepository)
    {
        $this->repository           = $repository;
        $this->validator            = $validator;
        $this->service              = $service;
        $this->patientRepository    = $patientRepository;
        $this->doctorRepository     = $doctorRepository;
        $this->secretariaRepository = $secretariaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendamentos       = $this->repository->all();
        $agendamento        = Agendamento::all();
        $patient_list       = $this->patientRepository->selectBoxList();
        $doctor_list        = $this->doctorRepository->selectBoxList();
        $secretaria_list    = $this->secretariaRepository->selectBoxList();
        //dd( $agendamentos );
        

        return view('agendamentos.form', [
            'agendamentos'      => $agendamentos,
            'patient_list'      => $patient_list,
            'doctor_list'       => $doctor_list,
            'secretaria_list'   => $secretaria_list,
        ]);
    }

    public function homepagePaciente(){
        $agendamentos       = $this->repository->all();
        $agendamento        = Agendamento::all();
        $patient_list       = $this->patientRepository->selectBoxList();
        $doctor_list        = $this->doctorRepository->selectBoxList();
        $secretaria_list    = $this->secretariaRepository->selectBoxList();
        //dd($horarios );


    
        return view('patient.homepage', [
            'agendamentos'      => $agendamentos,
            'patient_list'      => $patient_list,
            'doctor_list'       => $doctor_list,
            'secretaria_list'   => $secretaria_list,
        ]);

        return redirect()->route('agendamentos.show');
    }

    public function novoAgendamento(){
        $agendamentos       = $this->repository->all();
        $agendamento        = Agendamento::all();
        $patient_list       = $this->patientRepository->selectBoxList();
        $doctor_list        = $this->doctorRepository->selectBoxList();
        $secretaria_list    = $this->secretariaRepository->selectBoxList();
        //dd($horarios );
    
        return view('secretaria.novo-agendamento', [
            'agendamentos'      => $agendamentos,
            'patient_list'      => $patient_list,
            'doctor_list'       => $doctor_list,
            'secretaria_list'   => $secretaria_list,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AgendamentoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */


    public function create()
    {
        $method         = 'post';
        $agendamento    = new Agendamento();
        $patients       = Patient::all();
        $doctors        = Doctor::all();
        $secretarias    = Secretarias::all();

        return view('agendamentos.form')->with('patients', $patients)
                                        ->with('doctors', $doctors)
                                        ->with('secretarias', $doctors)
                                        ->with('method', $method)
                                        ->with('agendamento', $agendamento);
    }
	
	
	public function normalizaTempo($tempo, $dia_escolhido, $dias = true) {
		return app('App\Http\Controllers\AvailabilitiesController')->normalizaTempo($tempo, $dia_escolhido, $dias);
	}


    public function store(AgendamentoCreateRequest $request)
    {
		
		$request->merge(['dia_escolhido' => $request->input('data')]);
		$request->merge(['id_medico' => $request->input('id_doctor')]);
		
		
		$available_times = app('App\Http\Controllers\AvailabilitiesController')->ajaxcall($request);
				
		$available_times = json_decode($available_times->content(),true);
				
		if(isset($available_times[$request->input('hora')]) && $available_times[$request->input('hora')] === true) {
			
			$availability = DB::table('availabilities')
						->where('id_medico', $request->input('id_doctor'))
						->whereNull('deleted_at')
						->get();
						
			$exclusoes = $availability->first()->exclusoes.'['.Carbon::parse($request->input('data'))->format('d/m').']'.$request->input('hora');
			
			
			$affected = DB::table('availabilities')
						->where('id_medico', $request->input('id_doctor'))
						->whereNull('deleted_at')
						->update(['exclusoes' => $exclusoes]);
			
			$agendamento = new Agendamento();
			$agendamento->descricao     = $request->input('descricao');
			$agendamento->datahora      = Carbon::parse($request->input('data').' '.$request->input('hora'));
			$agendamento->id_doctor     = $request->input('id_doctor');
			$agendamento->id_patient    = $request->input('id_patient');
			$agendamento->secretaria_id = $request->input('secretaria_id');
			$agendamento->legenda       = $request->input('legenda');
			$agendamento->save();

		return redirect()->back();
			
		} else {
			
		return redirect()->back()->withErrors("Horário Indisponível");
		
		}
	
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */

    public function show()
    {
        $agendamentos       = $this->repository->all();
        $agendamento        = Agendamento::all();
        $patient_list       = $this->patientRepository->selectBoxList();
        $doctor_list        = $this->doctorRepository->selectBoxList();
        $secretaria_list    = $this->secretariaRepository->selectBoxList();
        //dd( $agendamentos );
        

        return view('agendamentos.show', [
            'agendamentos' => $agendamentos,
            'patient_list' => $patient_list
        ]);

    }

    public function showEnfermeiro()
    {
        $agendamentos       = $this->repository->all();
        $agendamento        = Agendamento::all();
        $patient_list       = $this->patientRepository->selectBoxList();
        $doctor_list        = $this->doctorRepository->selectBoxList();
        $secretaria_list    = $this->secretariaRepository->selectBoxList();
        //dd( $agendamentos );
        

        return view('agendamentos.showEnfermeiro', [
            'agendamentos' => $agendamentos,
            'patient_list' => $patient_list
        ]);

    }

    public function showMedico()
    {
        $agendamentos       = $this->repository->all();
        $agendamento        = Agendamento::all();
        $patient_list       = $this->patientRepository->selectBoxList();
        $doctor_list        = $this->doctorRepository->selectBoxList();
        $secretaria_list    = $this->secretariaRepository->selectBoxList();
        //dd( $agendamentos );
        

        return view('agendamentos.showMedico', [
            'agendamentos' => $agendamentos,
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
        $agendamento = $this->repository->find($id);

        return view('agendamentos.edit', compact('agendamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AgendamentoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AgendamentoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $agendamento = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Agendamento updated.',
                'data'    => $agendamento->toArray(),
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
		$agendamento = $this->repository->where('id',$id)->get()->first();
		
        $deleted = $this->repository->delete($id);
		
		$request = new \Illuminate\Http\Request();		
		
		$request->replace(['dia_escolhido'=> Carbon::parse($agendamento->datahora)->format('Y-m-d'), 'id_medico'=>$agendamento->id_doctor]);
		
		$available_times = app('App\Http\Controllers\AvailabilitiesController')->ajaxcall($request);
				
		$available_times = json_decode($available_times->content(),true);
				
		if(isset($available_times[$request->input('hora')]) && $available_times[$request->input('hora')] === false) {
			
			$availability = DB::table('availabilities')
						->where('id_medico', $request->input('id_doctor'))
						->whereNull('deleted_at')
						->get(); 
						
			$replace_day = str_replace('/','\/',Carbon::parse($request->input('hora'))->format('d/m'));			
						
			$exclusoes = preg_replace('/\['.$replace_day.'(.*?)\[/', '[', $availability->first()->exclusoes);
			
			
			$affected = DB::table('availabilities')
						->where('id_medico', $request->input('id_doctor'))
						->whereNull('deleted_at')
						->update(['exclusoes' => $exclusoes]);
						
		}

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Agendamento deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Agendamento deleted.');
    }
}
