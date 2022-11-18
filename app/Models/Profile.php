<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */

    protected $fillable = [
        'firstName', 'lastName','jobTitle','company','employeeNumber','gender','departmentNumber','department','phoneMobile','phoneWork','email','workgroup'
    ];

    public function getAddresses(){
        return $this->hasOne('App\Models\Addresses');
    }
}
