<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Guest extends Model
{
    use HasFactory;
    protected $table = 'guest_tokens';
    protected $fillable = [
        'user_id',
        'token',
        'expired_at'
    ];

    public function guest(){
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
