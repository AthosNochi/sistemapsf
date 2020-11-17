<?php

namespace App\Services;

use Exception;
use Illuminate\Database\QueryException;
use Prettus\Validator\Exceptions\ValidatorExceptions;
use Prettus\Validator\Contracts\ValidatorInterface;
use App\Repositories\AgendamentoRepository;
use App\Validators\AgendamentoValidator;

class AgendamentoService
{
    private $repository;
    private $validator;

    public function __construct(AgendamentoRepository $repository, AgendamentoValidator $validator)
    {
        $this->repository   = $repository;
        $this->validator    = $validator;
    }

    public function store()
    {
        try
        {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $agenda = $this->repository->create($data);

            return [
                'success'   => true,
                'messages'  => "Agendamento cadastrado",
                'data'      => $agenda,
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