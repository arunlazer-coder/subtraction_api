<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Maths extends Model
{
    // use SoftDeletes;
    const TN = 'maths';

    protected $table = Self::TN;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'status'
    ];

    public $timestamps = true;
}
