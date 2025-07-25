<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'company';

    protected $keyType = "string";
    public $incrementing = false;

    protected $fillable = [
        'name',
        'address',
        'industry',
        'website',
        'owner_id',
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


    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function JobVacancy()
    {
        return $this->hasMany(JobVacancy::class, 'company_id', 'id');
    }

    public function JobApplication() {
        return $this->hasManyThrough (JobApplication::class , JobVacancy::class ,'company_id', 'job_vacancy_id' , 'id' , 'id');
    }
}
