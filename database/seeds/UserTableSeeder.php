<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kloekecode')->truncate();

        DB::table('kloekecode')->insert(array(
            array('plaats'=>'john','provincie'=>'john@clivern.com'),
        ));
    }
}
