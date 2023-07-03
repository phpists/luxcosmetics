<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackReason extends Model
{
    use HasFactory;

    protected $table = 'feedbacks_reasons';

    public $timestamps = false;

    protected $fillable = ['reason'];
}
