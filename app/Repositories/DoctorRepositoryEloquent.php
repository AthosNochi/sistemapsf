<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DoctorRepository;
use App\Entities\Doctor;
use App\Validators\DoctorValidator;

/**
 * Class DoctorRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class DoctorRepositoryEloquent extends BaseRepository implements DoctorRepository
{

    public function selectBoxList(string $descricao = 'specialty', string $chave = 'id')
    {
        return $this->model->pluck($descricao, $chave)->all();
    }


    public function model()
    {
        return Doctor::class;
    }

    /**
    * Specify Validator class specialty
    *
    * @return mixed
    */
    public function validator()
    {

        return DoctorValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
