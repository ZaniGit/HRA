<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'company_id',
        'employe_id',
        'units',
        'type_exam',
        'done',
    ];

    protected $searchableFields = ['*'];

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
