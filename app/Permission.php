<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;

    const TN = DB_TBL_PREFIX.'permissions';

    protected $table = Self::TN;
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];  

    protected $fillable = [
        'title',
        'section_name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $timestamp = true;
}
