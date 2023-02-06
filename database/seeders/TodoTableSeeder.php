<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Seeder;

class TodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'content' => '掃除',
            'tag_id' => 1,
            'user_id' => 1
        ];
        Todo::create($param);
        $param = [
            'content' => '洗濯',
            'tag_id' => 1,
            'user_id' => 2
        ];
        Todo::create($param);
        $param = [
            'content' => '天神',
            'tag_id' => 12,
            'user_id' => 2
        ];
        Todo::create($param);
    }
}
