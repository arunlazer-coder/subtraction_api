<?php

namespace App\Model;
use App\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Maths extends Model
{
    // use SoftDeletes;
    const TN = DB_TBL_PREFIX.'maths';

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
