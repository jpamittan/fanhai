<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employee';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['department_id', 'fname', 'mname', 'lname', 'position', 'status'];

    /**
     * Get all phonebooks
     */
    public function phonebooks()
    {
        return $this->hasMany('App\Model\Phonebooks');
    }

    /**
     * Get all messages
     */
    public function messages()
    {
        return $this->hasMany('App\Model\Message');
    }
}
