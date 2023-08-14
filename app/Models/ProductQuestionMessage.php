<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductQuestionMessage extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'message', 'user_id', 'email', 'username'];
}
