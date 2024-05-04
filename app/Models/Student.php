<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard = 'student';
    //this is base on table name 
    protected $primarykey = 'id'; //of course this is the primary key of the table
    protected $fillable = [ //this are the column of table that needed to fill
        'lastname',
        'firstname',
        'middlename',
        'gender',
        'department',
        'email',
        'password',
         'photo' 
    ];
}
