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
        'stage_id',
        'group_id',
        'round_id',
        'opponent1_id',
        'opponent2_id',
        'opponent1_score',
        'opponent1_result',
        'opponent2_score',
        'opponent2_result',
        'bracket_position',
    ];

    protected $searchableFields = ['*'];
}
