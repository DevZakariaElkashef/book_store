<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;


    protected $table = 'notifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
    */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];


    protected $casts = [
        'data' => 'array', // Cast settings as an array (or use 'json')
        'id' => 'string'
    ];


}
