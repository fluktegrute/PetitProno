<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{

    protected $table = 'comments';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'comment_date',
        'user_id',
        'league_id',
        'comment',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public $timestamps;
}
