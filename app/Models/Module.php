<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'content',
        'order',
    ];

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function videos()
    {
        return $this->hasMany(ModuleVideo::class)->orderBy('order');
    }
}
