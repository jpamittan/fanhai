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
    protected $fillable = ['to', 'title', 'msg', 'type'];

    /**
     * Timestamp on updated_at column set to false
     *
     * @var bool
     */
    public $timestamps = false;
}
