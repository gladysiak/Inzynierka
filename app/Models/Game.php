<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['game_name', 'game_desc', 'game_players_num', 'game_players_age', 'game_producer', 'game_image', 'game_verified'];

    public function scopeFilter($query, array $filters) {
        if($filters['search'] ?? false) {
            $query->where('game_name', 'like', '%' . request('search') . '%');
        }
    }
}
