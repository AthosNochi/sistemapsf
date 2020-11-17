<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AvailabilityRepository;
use App\Entities\Availability;
use App\Validators\AvailabilityValidator;

/**
 * Class AvailabilityRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AvailabilityRepositoryEloquent extends BaseRepository implements AvailabilityRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Availability::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AvailabilityValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
