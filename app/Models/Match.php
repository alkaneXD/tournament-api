<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Match extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'stage_id',
        'group_id',
        'round_id',
        'number',
        'opponent1_id',
        'opponent1_score',
        'opponent1_result',
        'opponent1_position',
        'opponent2_id',
        'opponent2_score',
        'opponent2_result',
        'opponent2_position',
    ];

    protected $searchableFields = ['*'];
}
