<?php

namespace App\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Availability.
 *
 * @package namespace App\Entities;
 */
class Availability extends Model implements Transformable
{
    use TransformableTrait;
    use Notifiable;
    use SoftDeletes;

    //** the ORM database atributes **//


   public 	 $timestamps   =  true;
   protected $table        = 'availabilities';
   protected $fillable     = ['id_medico', 'consulta', 'disponibilidade', 'adicoes', 'exclusoes'];
   protected $hidden       = [];

}
