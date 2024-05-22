<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

protected $guarded = false;
//    protected $fillable = [
//        'title', // Добавляем 'title' к массиву fillable
//        'content',
//        'slug',
//        'category_id',
//        'image'
//        // Другие поля, разрешенные для массового заполнения
//    ];
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
