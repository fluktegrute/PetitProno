<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLeague extends Model
{
    protected $table = 'user_league';

    protected $primaryKey = 'id';

    protected $fillable = [
        'league_id',
        'user_id',
    ];
}