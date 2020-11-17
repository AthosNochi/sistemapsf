<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EnfermeiroRepository;
use App\Entities\Enfermeiro;
use App\Validators\EnfermeiroValidator;

/**
 * Class EnfermeiroRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EnfermeiroRepositoryEloquent extends BaseRepository implements EnfermeiroRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Enfermeiro::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return EnfermeiroValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
