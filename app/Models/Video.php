<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = 'videos'; // تحديد اسم الجدول

    protected $fillable = [
        'title',
        'url',
        'category_id', // مفتاح خارجي لفئة الضغوطات
    ];

    // علاقة مع الفئة
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
