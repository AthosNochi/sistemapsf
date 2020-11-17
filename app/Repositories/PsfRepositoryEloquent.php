<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PsfRepository;
use App\Entities\Psf;
use App\Validators\PsfValidator;

/**
 * Class PsfRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PsfRepositoryEloquent extends BaseRepository implements PsfRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Psf::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PsfValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
