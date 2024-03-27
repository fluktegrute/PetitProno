<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class League extends Model
{
    protected $table = 'league';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'created_by',
    ];
}