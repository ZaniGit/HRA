<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'document_cnpj',
        'fantasy_name',
        'zip_code',
        'address',
        'number',
        'complement',
        'city',
        'state',
        'district',
        'telephone',
        'cell_phone',
    ];

    protected $searchableFields = ['*'];

    public function employe()
    {
        return $this->hasOne(Employe::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function getCellPhoneFormatedAttribute()
    {
        return $this->numericMaskRemove($this->cell_phone);
    }

    public function getDocumentCnpjFormatedAttribute()
    {
        return $this->numericMaskRemove($this->document_cnpj);
    }

    public function getZipCodeFormatedAttribute()
    {
        return $this->numericMaskRemove($this->zip_code);
    }

    public function getTelephoneFormatedAttribute()
    {
        return $this->numericMaskRemove($this->telephone);
    }

    private function numericMaskRemove($value)
    {
        return preg_replace('/[^0-9]/', '', $value);
    }
}
