<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['role'] ?? false, function ($query, $role) {
            return $query->where('role', $role);
        });

        $query->when($filters['start_date'] ?? false, function ($query, $date) {
            return $query->whereDate('created_at', '>=', $date);
        });

        $query->when($filters['end_date'] ?? false, function ($query, $date) {
            return $query->whereDate('created_at', '<=', $date);
        });

        $query->when($filters['sort'] ?? null, function ($query, $sort) {
            switch ($sort) {
                case 'nama_asc':
                    return $query->orderBy('name', 'asc');
                case 'nama_desc':
                    return $query->orderBy('name', 'desc');
                case 'tanggal_desc':
                case 'latest':
                    return $query->latest();
                case 'tanggal_asc':
                case 'oldest':
                    return $query->oldest();
                default:
                    return $query->oldest();
            }
        });
    }
}
