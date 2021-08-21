<?php

namespace App\Model;
use App\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    // use SoftDeletes;
    const TN = DB_TBL_PREFIX.'customer';

    protected $table = Self::TN;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'status'
    ];

    public $timestamps = true;
}
