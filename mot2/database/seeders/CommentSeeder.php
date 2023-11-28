<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // commentsテーブルへのダミーデータ登録
        DB::table('comments')->insert(
            [
                [
                    'comment' => 'テストコメント4です',
                    'topic_id' => 1,
                    'user_id' => 1,
                ]
            ]
        );
    }
}
