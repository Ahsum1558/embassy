<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionCustomer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}