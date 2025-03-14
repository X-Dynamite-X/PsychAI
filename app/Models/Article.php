<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles'; // تحديد اسم الجدول

    protected $fillable = [
        'title',
        'content',
        'category_id', // مفتاح خارجي لفئة الضغوطات
    ];

    // علاقة مع الفئة
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    //
}