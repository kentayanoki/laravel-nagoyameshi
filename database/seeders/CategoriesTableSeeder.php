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
        $major_category_names = [
            '料理'
        ];

        $shop_categories = [
            '焼肉', '寿司', 'ラーメン', '定食',
            'カレー', '喫茶店', '中華料理', 'イタリアン料理',
            'スペイン料理', '韓国料理', '海鮮料理', 'そば',
            'うどん', 'お好み焼き', 'たこ焼き', '鍋料理',
            'パン', 'スイーツ', '和食'
        ];

        foreach ($major_category_names as $major_category_name) {
            if ($major_category_name == '料理') {
                foreach ($shop_categories as $shop_category) {
                    Category::create([
                        'name' => $shop_category,
                        'description' => $shop_category,
                        'major_category_name' => $major_category_name
                    ]);
                }
            }
        }
    }
}
