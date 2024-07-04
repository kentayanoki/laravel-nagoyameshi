<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shop;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ShopFactoryクラスで定義した内容にもとづいてダミーデータを20件生成し、productsテーブルに追加する
        Shop::factory()->count(20)->create();
    }
}
