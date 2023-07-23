<?php

namespace App\Models;

use App\Events\GroupCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['group_name'];

    protected static function booted()
    {
        static::created(function ($group) {
            event(new GroupCreated($group));
        });
    }

    public function scopeFilter($query, array $filters) {
        if($filters['search'] ?? false) {
            $query->where('group_name', 'like', '%' . request('search') . '%');
        }
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_group');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
