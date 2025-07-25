<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resume extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'resume';

    protected $keyType = "string";
    public $incrementing = false;

    protected $fillable = [
        "fileName",
        "fileUrl",
        "contactDetails",
        "education",
        "summary",
        "skills",
        "experience",
        "user_id",
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

        public function JobApplication()
    {
        return $this->hasMany(JobApplication::class, 'resume_id', 'id');
    }
}
