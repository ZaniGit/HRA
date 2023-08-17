<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employe extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'telephone',
        'cell_phone',
        'telephone_emergency',
        'birth',
        'nationality',
        'gender',
        'color',
        'scholarity',
        'civil_status',
        'sons',
        'name_dad',
        'name_mother',
        'zip_code',
        'andress',
        'number',
        'complement',
        'city',
        'state',
        'district',
        'document_rg',
        'organization_exp',
        'date_emission_rg',
        'document_cpf',
        'document_ctps',
        'document_ctps_serie',
        'date_emission_ctps',
        'document_pis',
        'document_title',
        'document_title_zone',
        'document_title_session',
        'date_emission_title',
        'document_reservist',
        'document_cnh',
        'document_cnh_category',
        'email',
        'company_id',
        'job_functions_id',
        'date_admission',
        'document',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'birth' => 'date',
        'date_emission_rg' => 'date',
        'date_emission_ctps' => 'date',
        'date_emission_title' => 'date',
        'date_admission' => 'date',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function jobFunctions()
    {
        return $this->belongsTo(JobFunctions::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function dependents()
    {
        return $this->hasMany(Dependent::class);
    }

    public function getTelephoneFormatedAttribute()
    {
        return $this->numericMaskRemove($this->telephone);
    }

    public function getTelephoneEmergencyFormatedAttribute()
    {
        return $this->numericMaskRemove($this->telephone_emergency);
    }

    public function getCellPhoneFormatedAttribute()
    {
        return $this->numericMaskRemove($this->cell_phone);
    }

    private function numericMaskRemove($value)
    {
        return preg_replace('/[^0-9]/', '', $value);
    }
}
