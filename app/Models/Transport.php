<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transport extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'active'];

    protected $searchableFields = ['*'];
}
