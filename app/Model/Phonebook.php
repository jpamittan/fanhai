<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Phonebook extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'phonebook';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

     /**
     * The attributes that are mass assignable.
     *
     * @var arrays
     */
    protected $fillable = [
        'employee_id',
        'address',
        'work_email',
        'email',
        'home_phone',
        'work_phone',
        'mobile_phone'
    ];
}
