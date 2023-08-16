<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentsAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_like',
        'record_id',
        'table_name',
        'client_ip'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
