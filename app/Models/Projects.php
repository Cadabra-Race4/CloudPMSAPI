<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Projects extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'project_admin',
        'meta',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_members', 'project_id', 'user_id' );
    }
}
