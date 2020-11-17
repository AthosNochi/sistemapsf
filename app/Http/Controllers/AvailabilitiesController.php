<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AvailabilityCreateRequest;
use App\Http\Requests\AvailabilityUpdateRequest;
use App\Repositories\AvailabilityRepository;
use App\Repositories\PatientRepository;
use App\Repositories\DoctorRepository;
use App\Validators\AvailabilityValidator;
use App\Services\AvailabilityService;
use App\Entities\Availability;
use App\Entities\Patient;
use App\Entities\Doctor;
use Carbon\Carbon;

/**
 * Class AvailabilitiesController.
 *
 * @package namespace App\Http\Controllers;
 */
class AvailabilitiesController extends Controller
{
    /**
     * @var AvailabilityRepository
     */
    protected $repository;
    protected $validator;
    protected $service;
    protected $patientRepository;
    protected $doctorRepository;

    /**
     * AvailabilitiesController constructor.
     *
     * @param AvailabilityRepository $repository
     * @param AvailabilityValidator $validator
     */
    public function __construct(AvailabilityRepository $repository, AvailabilityValidator $validator, AvailabilityService $service, PatientRepository $patientRepository, DoctorRepository $doctorRepository)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service              = $service;
        $this->patientRepository    = $patientRepository;
        $this->doctorRepository     = $doctorRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $availabilities = $this->repository->all();
        $patient_list       = $this->patientRepository->selectBoxList();
        $doctor_list        = $this->doctorRepository->selectBoxList();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $availabilities,
            ]);
        }

        return view('availabilities.index',[
            'availabilities'      => $availabilities,
            'patient_list'      => $patient_list,
            'doctor_list'       => $doctor_list,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AvailabilityCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AvailabilityCreateRequest $request)
    {
        try {
						
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
			
			$medico = $request->input('id_medico');
			$disponibilidades = json_encode($request->input('disponibilidade'));
			
			
			$requestdata = array('id_medico' => $medico, 'consulta' => $request->input('consulta'), 'disponibilidade' => $disponibilidades, 'adicoes' => $request->input('adicoes'), 'exclusoes' => $request->input('exclusoes'), 'deleted_at' => null);
			
			

            $availability = $this->repository->updateOrCreate($requestdata, ['id_medico' => $medico]);

            $response = [
                'message' => 'Availability created.',
                'data'    => $availability->toArray(),
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
	
	public function normalizaTempo($tempo, $dia_escolhido, $dias = true) {
		
		
		$blocos = array();
		$horas = array();
		$minutos = array();
		
		if ($dias == true) {
			
			$blocos2 = array();
				
			$blocos2 = array_filter(explode('[', $tempo),function($val) {
				return ($val !== null && $val !== false && $val !== ''); 
			});
			
			
			
			foreach ($blocos2 as $key => $value) {
				
				if (strpos($value,'/') !== false) {
				
					$temp = explode('/', $value);
					$temp2 = explode(']',$temp[1]);
				
				
					if ( checkdate($temp2[0], $temp[0], date('Y')) ) {
						$blocos[$temp[0].'/'.$temp2[0]] = empty($temp2[1]) ? ['0-24'] : array_filter(explode(';', $temp2[1]),function($val) {
							return ($val !== null && $val !== false && $val !== ''); 
						});
					}
				
				} else { 
					continue;
				}
			}
		} else {
						
			$blocos[Carbon::parse($dia_escolhido)->format('d/m')] = array_filter(explode(';', $tempo),function($val) {
				return ($val !== null && $val !== false && $val !== ''); 
			});
		}
		
		
		
		foreach ($blocos as $k => $v) {
			
			foreach($v as $key => $value) {
			
				$horas[$k][$key] = array_filter(explode('-', $value),function($val) {
					return ($val !== null && $val !== false && $val !== ''); 
				});
				
			}
		}
		
		
		foreach ($horas as $key => $value) {
			
			foreach ($value as $key2 => $value2) {
				foreach ($value2 as $k => $v) {
					
					$minutos[$key][$key2][$k] = array_filter(explode(':', $v),function($val) {
					return ($val !== null && $val !== false && $val !== ''); 
				});
				}
			}
		}
		
		
		foreach($minutos as $k => $v) {
			
			foreach ($v as $key => $value) {
				foreach ($value as $key2 => $value2) {
				
					$value2[0] = preg_replace('/[^0-9]/','',$value2[0]);
				
				if (!isset($value2[1]) || (empty(preg_replace('/[^0-9]/','',$value2[1])) && (preg_replace('/[^0-9]/','',$value2[1]) != 0))) {$value2[1] = 0;} else {preg_replace('/[^0-9]/','',$value2[1]);}
					
					
					if (!isset($value2[0]) || $value2[0] == '' || $value2[0] >= 24 || $value2[0] < 0) {
						
						$value2[0] = 23;
						$value2[1] = 59;
					}			
					
					if ($value2[1] >= 60 || $value2[1] < 0) {
						
						$value2[1] = 59;
					}
					
				
					$horas[$k][$key][$key2] = $value2[0].':'.$value2[1];
				
				}
			}
		}
		
		foreach ($horas as $k => $v) {
			foreach ($v as $key => $value) {
				
	
				if (empty($value[1])) {$value[1] = $value[0];}
				
				if (Carbon::parse($value[0])->gt(Carbon::parse($value[1]))) {
					
					$temp = $value[0];
					$value[0] = $value[1];
					$value[1] = $temp;
					
				}
				
				$blocos[$k][$key] = $value[0].'-'.$value[1];	
				
			}
		}
		
		return $blocos;
	}
	
	public function ajaxcall(Request $request){
		
        $dia_escolhido = Carbon::createFromFormat('Y-m-d',$request->input('dia_escolhido'));
		$medico = $request->input('id_medico');
        $disponibilidades = Availability::where('id_medico',"=",$medico)->get()->first();
        $dia_semana = $dia_escolhido->dayOfWeek;
		$horarios = json_decode($disponibilidades['disponibilidade'],true);
		$adicoes = $this->normalizaTempo($disponibilidades['adicoes'],$dia_escolhido);
		$exclusoes = $this->normalizaTempo($disponibilidades['exclusoes'],$dia_escolhido);
		$connum = preg_replace("/[^0-9]/", "",$disponibilidades['consulta']);
		$consulta = empty($connum) ? 5*60 : ($connum > 60 ? 60*60 : $connum*60); // Tempo de consulta em segundos
		
		$response = Http::get('https://api.calendario.com.br/?json=true&token=bWlndWVsdmllaXJhcnRAb3V0bG9vay5jb20maGFzaD0yMTY5MTk0MDk&ano='.$dia_escolhido->year.'&ibge=3550308');
		
		$feriados_ano = json_decode($response->body());
		
		$feriado = array_search(Carbon::parse($dia_escolhido)->format('d/m/Y'), $feriados_ano);
		
		if ($feriado !== false && $feriado < 4) {
		
			$horarios = $this->normalizaTempo($horarios[7],$dia_escolhido,false);
	
		} else {
			
			$horarios = $this->normalizaTempo($horarios[$dia_semana],$dia_escolhido,false);
			
		}
		
		
		if (!empty($adicoes[$dia_escolhido->format('d/m')])) {
			
			$horarios[$dia_escolhido->format('d/m')] = array_merge($horarios[$dia_escolhido->format('d/m')],$adicoes[$dia_escolhido->format('d/m')]);
		
		}
		
		
		$available_times = array();
		
		foreach($horarios as $k => $v) {
			foreach($v as $key => $value) {
				
				$times = explode('-',$value);
				
				$timerange = range(Carbon::parse($times[0])->format('U'),Carbon::parse($times[1])->format('U'),$consulta);
				
				foreach($timerange as $timev) {
					$available_times[Carbon::parse($timev)->format('H:i')] = true;
				}
			}
		}
		
		
		if (!empty($exclusoes[$dia_escolhido->format('d/m')])) {
			
			foreach($exclusoes[$dia_escolhido->format('d/m')] as $k => $v) {
				
				
				$times = explode('-',$v);
				
				
				$timerange = range(Carbon::parse($times[0])->format('U'),Carbon::parse($times[1])->format('U'),$consulta);
				
				foreach($timerange as $timev) {
					$available_times[Carbon::parse($timev)->format('H:i')] = false;
				}
			
			}
		
		}
		
		
        return response()->json($available_times);
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
        $availability = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $availability,
            ]);
        }

        return view('availabilities.show', compact('availability'));
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
        $availability = $this->repository->find($id);

        return view('availabilities.edit', compact('availability'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AvailabilityUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AvailabilityUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $availability = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Availability updated.',
                'data'    => $availability->toArray(),
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
                'message' => 'Availability deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Availability deleted.');
    }
}
