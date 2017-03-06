<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name' => 'Administrador',
            'lastname' => 'Sistema',
            'idcard' => '11111111',
            'sex' => 'f',
            'birtdate' => '1991-05-08',
            'phone' => '09001728888',
            'cellphone' => '09001728888',
            'email' => 'admin@sistemaservmedico.com',
            'password' => bcrypt('123123'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        	]);
    }
}