<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'user_id' => '3',
            'title' => 'test1',
            'tag' => 'test1',
            'image1' => 'test1',
            'camera_id' => '123',
            'lens_id' => '123',
            'spot_name' => 'test',
            'spot_address' => 'test',
            'longitude' => '123',
            'latitude' => '123',  
            'del_flg' => '0',          
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

    }
}
