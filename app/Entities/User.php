<?php

namespace App\Entities;

use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use TransformableTrait;

    //** the ORM database atributes **//


   public 	 $timestamps   =  true;
   protected $table        = 'users';
   protected $fillable     = ['name', 'email', 'password', 'isAdm'];
   protected $hidden       = ['password', 'remember_token'];

   
 

   //public function getPhoneAttribute()
   //{
   //    $phone = $this->attributes['phone'];
   //    return "(" . substr($phone, 0, 2) . ")" . substr($phone, 2, 4) . "-" . substr($phone, -4) ;
  // }

  public function setPasswordAttribute ($value)
  {
      $this->attributes['password'] = Hash::make($value);
  } 

}
