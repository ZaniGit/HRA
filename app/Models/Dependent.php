<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dependent extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'birth',
        'document_cpf',
        'kinship',
        'dependent_ir',
        'employe_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'birth' => 'date',
    ];

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }
}
