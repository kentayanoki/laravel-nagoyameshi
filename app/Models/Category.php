<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;

class Category extends Model
{
    use HasFactory;

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    public function majorCategory()//親カテゴリーとのリレーション カテゴリーは1つの親カテゴリーに属するからbelongto
    {
        return $this->belongsTo(MajorCategory::class, 'major_category_id');
    }
}
