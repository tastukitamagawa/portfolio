<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'word_id'
    ];

    public function word(){
        return $this->belongsTo(Word::class, 'word_id', 'word_id');
    }
}
