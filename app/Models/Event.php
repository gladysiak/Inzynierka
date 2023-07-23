<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'start', 'end', 'user_id',
    ];

    /**
     * Zwraca użytkownika powiązanego z wydarzeniem.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Zwraca grupę powiązaną z wydarzeniem.
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}


