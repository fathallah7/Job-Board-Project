<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplication extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'job_application';

    protected $keyType = "string";
    public $incrementing = false;

    protected $fillable = [
        "status",
        "aiGeneratedScore",
        "aiGeneratedFeedback",
        "user_id",
        "resume_id",
        "job_vacancy_id",
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

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function JobVacancy()
    {
        return $this->belongsTo(JobVacancy::class, 'job_vacancy_id', 'id');
    }

    public function Resume()
    {
        return $this->belongsTo(Resume::class, 'resume_id', 'id');
    }
}
