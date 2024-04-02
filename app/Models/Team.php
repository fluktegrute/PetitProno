<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    protected $table = 'teams';

    protected $primaryKey = 'id';

    protected $corresp = [
            'Germany' => 'Allemagne',
            'Scotland' => 'Écosse',
            'Hungary' => 'Hongrie',
            'Switzerland' => 'Suisse',
            'Spain' => 'Espagne',
            'Croatia' => 'Croatie',
            'Italy' => 'Italie',
            'Albania' => 'Albanie',
            'Slovenia' => 'Slovénie',
            'Denmark' => 'Danemark',
            'Serbia' => 'Serbie',
            'England' => 'Angleterre',
            'Belgium' => 'Belgique',
            'Slovakia' => 'Slovaquie',
            'Austria' => 'Autriche',
            'France' => 'France',
            'Portugal' => 'Portugal',
            'Czech Republic' => 'République Tchèque',
            'Netherlands' => 'Pays-Bas',
            'Turkey' => 'Turquie',
            'Romania' => 'Roumanie',
            'Georgia' => 'Géorgie', 
            'Poland' => 'Pologne',
            'Ukraine' => 'Ukraine',
        ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'api_id',
        'name',
        'group',
        'position',
        'flag',
        'played',
        'won',
        'draw',
        'lost',
        'points',
        'goals_for',
        'goals_against',
        'goal_diff',
        'is_winner',
    ];

    public $timestamps;

    public function name(){
        return $this->corresp[$this->name] ?? $this->name;
    }
}
