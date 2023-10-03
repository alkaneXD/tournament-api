<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Round extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['group_id', 'number', 'matches_count'];

    protected $searchableFields = ['*'];

    public $timestamps = false;

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function fights(): HasMany
    {
        return $this->hasMany(Fight::class);
    }
}
