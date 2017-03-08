<?php

use Illuminate\Database\Seeder;

class MedicinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medicines')->insert([
        	'name' => 'Acetaminofen',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        	]);
    }
}
