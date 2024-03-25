<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ECMatch extends Model
{

    protected $table = 'matches';

    protected $primaryKey = 'id';

    protected $corresp_stage = [
            'GROUP_STAGE' => 'Phase de poules',
            'LAST_16' => '8ème de finale',
            'QUARTER_FINALS' => 'Quart de finale',
            'SEMI_FINALS' => 'Demi-finale',
            'THIRD_PLACE' => 'Petite finale',
            'FINAL' => 'Finale',
        ];

    protected $corresp_group = [
            'GROUP_A' => 'Groupe A',
            'GROUP_B' => 'Groupe B',
            'GROUP_C' => 'Groupe C',
            'GROUP_D' => 'Groupe D',
            'GROUP_E' => 'Groupe E',
            'GROUP_F' => 'Groupe F',
        ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'api_id',
        'date',
        'stage',
        'group',
        'home_team',
        'away_team',
        'winner',
        'home_goals',
        'away_goals',
    ];

    public $timestamps;

    public function home_team(){
        return $this->belongsTo(Team::class, 'home_team', 'api_id');
    }

    public function away_team(){
        return $this->belongsTo(Team::class, 'away_team', 'api_id');
    }

    public function stage(){
        return $this->corresp_stage[$this->stage] ?? '';
    }

    public function group(){
        return $this->corresp_group[$this->group] ?? '';
    }
}
