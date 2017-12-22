<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * TODO description -> summary, and add author and subtitle
     */
    protected $fillable = [
        'title', 'subtitle', 'date', 'author', 'number', 'summary', 'filepath'
    ];

    protected $guarded = [
        'show_id'
    ];
}
