<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lenses')->insert([
            'maker' => 'PENTAX',
            'name' => 'HD PENTAX-DA 16-85mmF3.5-5.6',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
