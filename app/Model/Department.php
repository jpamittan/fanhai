<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'department';

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
    protected $fillable = ['company_id', 'name'];

    /**
     * Get the employees
     */
    public function employees()
    {
        return $this->hasMany('App\Model\Employee');
    }
}
