<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AnamneseRepository;
use App\Entities\Anamnese;
use App\Validators\AnamneseValidator;

/**
 * Class AnamneseRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AnamneseRepositoryEloquent extends BaseRepository implements AnamneseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Anamnese::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AnamneseValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
