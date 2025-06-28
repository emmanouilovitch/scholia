<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'type',
        'phone',
        'email',
    ];

    /**
     * Get the user that owns the establishment (the creator).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the school classes for the establishment.
     */
    // public function schoolClasses()
    // {
    //     return $this->hasMany(SchoolClass::class);
    // }

    // Vous pouvez ajouter une relation many-to-many pour les membres si besoin
    // public function members()
    // {
    //     return $this->belongsToMany(User::class, 'establishment_members');
    // }
}