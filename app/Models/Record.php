<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'date'    
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function doctor() {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
