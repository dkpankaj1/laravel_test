<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'title',
        'description',
        'completed',
        'category_id',
    ];

    protected $casts = [
        'completed' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // Methods to test
    public function markAsCompleted(): void
    {
        $this->completed = true;
    }

    public function markAsIncomplete(): void
    {
        $this->completed = false;
    }
}
