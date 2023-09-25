<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['tournament_id', 'name'];

    protected $searchableFields = ['*'];

    public $timestamps = false;

    public function rounds()
    {
        return $this->hasMany(Round::class);
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }
}
