<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $major_category_ids = [
            1,2
        ];

        $shop_categories = [
            '焼肉', '寿司', '定食',
            '喫茶店', '中華料理', 'イタリアン料理',
            'スペイン料理', '韓国料理', '海鮮料理', 
            '鍋料理', '和食'
        ];

        $shop2_categories = [
            'ラーメン', 'カレー', 'そば',
            'うどん', 'お好み焼き', 'たこ焼き', 
            'パン', 'スイーツ'
        ];

        foreach ($major_category_ids as $major_category_id) {
            $categories = $major_category_id == 1 ? $shop_categories : $shop2_categories;
            
            foreach ($categories as $category_name) {
                Category::create([
                    'name' => $category_name,
                    'description' => $category_name,
                    'major_category_id' => $major_category_id
                ]);
            }
        }
    }
}
