<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * Get all of the risks for the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function risks()
    {
        return $this->hasMany(Risk::class);
    }

    public function members()
    {
        return $this->hasMany(TeamMember::class);
    }
}
