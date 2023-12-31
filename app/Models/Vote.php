<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = ['choice_id', 'user_id'];

    public function choice()
    {
        return $this->belongsTo(Choice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
