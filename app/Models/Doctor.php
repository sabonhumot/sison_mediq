<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Role;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'role_id'];
    public function role() {
        return $this->belongsTo(Role::class);
    }
}
