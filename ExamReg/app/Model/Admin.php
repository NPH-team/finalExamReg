<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';
    protected $primaryKey ='username';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'username',
        'password'
    ];

}
