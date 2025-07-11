<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobVacancy extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'job_vacancy';

    protected $keyType = "string";
    public $incrementing = false;

    protected $fillable = [
        'title',
        'description',
        'location',
        'salary',
        'type',
        'company_id',
        'category_id',
    ];
    
    protected $dates = [
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
        ];
    }

    public function jobCategory() {
        return $this->belongsTo(JobCategory::class , 'category_id','id');
    }

    public function Company() {
        return $this->belongsTo(Company::class ,'company_id','id');
    }

    public function JobApplication()
    {
        return $this->hasMany(JobApplication::class, 'job_vacancy_id', 'id');
    }
}
