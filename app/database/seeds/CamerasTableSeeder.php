<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CamerasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cameras')->insert([
            'maker' => 'PENTAX',
            'name' => 'K-70',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
