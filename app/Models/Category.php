<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use HasFactory;

    protected $table = 'categories'; // تحديد اسم الجدول

    protected $fillable = [
        'name',
        'description',
    ];

    public function articles()
    {
      return  $this->hasMany(Article::class);
    }
    public function videos()
    {
      return  $this->hasMany(Video::class);
    }
    public function specialist()
    {
        return $this->hasMany(Specialist::class);
    }
}
