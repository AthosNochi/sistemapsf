<?php

namespace App\Services;

use Exception;
use Illuminate\Database\QueryException;
use Prettus\Validator\Exceptions\ValidatorExceptions;
use Prettus\Validator\Contracts\ValidatorInterface;
use App\Repositories\PatientRepository;
use App\Validators\PatientValidator;

class PatientService
{
    private $repository;
    private $validator;


    public function __construct(PatientRepository $repository, PatientValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function store($data)
    {
        try
        {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $patient = $this->repository->create($data);

            return [
                'success'   => true,
                'messages'  => "Paciente cadastrado",
                'data'      => $patient,
            ];
        }

        catch(Exception $e)
        {
            switch(get_class($e))
            {

                case QueryException::class      : return ['success' => false, 'messages' => $e->getMessage()];
                case ValidatorException::class  : return ['success' => false, 'messages' => $e->getMessageBag()];
                case Exception::class           : return ['success' => false, 'messages' => $e->getMessage()];
                default                         : return ['success' => false, 'messages' => $e->getMessage()];
            }
        }
    }
    public function update(){}
    
    public function destroy($data)
    {
        try
        {
            $patient = $this->repository->delete($data);


            return [
                'success'   => true,
                'messages'  => "Paciente removido",
                'data'      => $patient,
            ];
        }

        catch(Exception $e)
        {
            switch(get_class($e))
            {

                case QueryException::class      : return ['success' => false, 'messages' => $e->getMessage()];
                case ValidatorException::class  : return ['success' => false, 'messages' => $e->getMessageBag()];
                case Exception::class           : return ['success' => false, 'messages' => $e->getMessage()];
                default                         : return ['success' => false, 'messages' => $e->getMessage()];
            }
        }
    }
    
}