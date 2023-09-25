<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Round extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['group_id', 'number', 'matches_count'];

    protected $searchableFields = ['*'];

    public $timestamps = false;

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function fights()
    {
        return $this->hasMany(Fight::class);
    }
}
