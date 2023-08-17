<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobFunctions extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'salary',
        'start_time',
        'end_time',
        'time_output_interval',
        'time_entry_interval',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'job_functions';

    public function employes()
    {
        return $this->hasMany(Employe::class);
    }
}
