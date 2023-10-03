<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fight extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'round_id',
        'player_one_id',
        'player_two_id',
        'winner_id',
        'bracket_position',
        'next_fight_id'
    ];

    protected $searchableFields = ['*'];

    public $timestamps = false;

    public function round()
    {
        return $this->belongsTo(Round::class);
    }
}
