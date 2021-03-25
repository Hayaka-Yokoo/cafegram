<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['id' => 1, 'category_name' => 'ケーキ'],
            ['id' => 2, 'category_name' => 'パンケーキ'],
            ['id' => 3, 'category_name' => 'アイス'],
            ['id' => 4, 'category_name' => 'ドーナツ'],
            ['id' => 5, 'category_name' => 'パン'],
            ['id' => 6, 'category_name' => 'チーズケーキ'],
            ['id' => 7, 'category_name' => 'モンブラン'],
            ['id' => 8, 'category_name' => 'シュークリーム'],
            ['id' => 9, 'category_name' => 'エクレア'],
            ['id' => 10, 'category_name' => 'チョコレート'],
            ['id' => 11, 'category_name' => 'プリン'],
            ['id' => 12, 'category_name' => 'パフェ'],
            ['id' => 13, 'category_name' => '抹茶'],
            ['id' => 14, 'category_name' => 'いちご'],
            ['id' => 15, 'category_name' => '和菓子'],
            ['id' => 16, 'category_name' => 'ピスタチオ'],
            ['id' => 17, 'category_name' => 'クレープ'],
            ['id' => 18, 'category_name' => 'マカロン'],
            ['id' => 19, 'category_name' => 'かき氷'],
            ['id' => 20, 'category_name' => 'ドリンク'],
            ['id' => 21, 'category_name' => 'フルーツ'],
            ['id' => 22, 'category_name' => '食事系'],
        ];
        DB::table('categories')->insert($categories);
    }
}
