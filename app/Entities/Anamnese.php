<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Anamnese.
 *
 * @package namespace App\Entities;
 */
class Anamnese extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = ['name','gender','age','corEtnia','estadoCivil','profissao','naturalidade','address','nomeMae','religiao','alergias','queixaPrincipal','historicoDoenca','sintomas','doctor_id','enfermeiro_id','updated_at','dados','id_patient', 'secretaria_id'];
    
   
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id_patient');
    }

    public function secretaria()
    {
        return $this->belongsTo(Secretaria::class, 'secretaria_id');
    }
}
