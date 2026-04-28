<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModuleProgress extends Model
{
    use HasFactory;

    protected $table = 'user_module_progress';

    protected $fillable = [
        'user_id',
        'module_id',
        'is_unlocked',
        'is_completed',
        'score',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
