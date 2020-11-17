<?php

namespace App\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class Patient extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    //** the ORM database atributes **//


   public    $timestamps   =  true;
   protected $table        = 'patients';
   protected $fillable     = ['name', 'email','password', 'tipo', 'cpf', 'rg', 'birth', 'gender', 'phone', 'address', 'sus', 'notes'];
   protected $hidden       = ['password', 'remember_token'];


  public function setPasswordAtributte($value){
    $this->attributes['password'] = Hash::make($value);
  }

   public function getCpfAttribute()
   {
        $cpf = $this->attributes['cpf'];
        return substr($cpf, 0, 3). '.' . substr($cpf, 3, 3). '.' . substr($cpf, 6, 3). '-' . substr($cpf, -2);
   }

   public function setDataAttribute($value)
   {
     $dia = substr($value, 8, 2);
     $mes = substr($value, 5, 2);
     $ano = substr($value, 0, 4);

     $this->attributes['data'] = Carbon::create($ano, $mes, $dia, 0, 0);
   }

}
