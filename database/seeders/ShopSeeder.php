<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ProductFactoryクラスで定義した内容にもとづいてダミーデータを20件生成し、productsテーブルに追加する
        Shop::factory()->count(20)->create();
    }
}
