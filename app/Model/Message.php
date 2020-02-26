<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'message';

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
    protected $fillable = ['from', 'to', 'msg', 'type'];
}
