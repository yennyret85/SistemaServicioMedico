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
            'address' => 'Caracas',
            'email' => 'admin@sistemaservmedico.com',
            'password' => bcrypt('123123'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        	]);

        DB::table('users')->insert([
            'name' => 'Gustavo',
            'lastname' => 'Laguna',
            'idcard' => '19005898',
            'sex' => 'm',
            'birtdate' => '1989-12-06',
            'phone' => '02682523395',
            'cellphone' => '04246571918',
            'address' => 'Caracas',
            'email' => 'gustavo.gelf@gmail.com',
            'password' => bcrypt('123123'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            ]);

        DB::table('users')->insert([
            'name' => 'Maria',
            'lastname' => 'Donquis',
            'idcard' => '7474634',
            'sex' => 'f',
            'birtdate' => '1960-07-29',
            'cellphone' => '04140743867',
            'address' => 'Coro',
            'email' => 'mariadonquis07@gmail.com',
            'password' => bcrypt('123123'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            ]);

        DB::table('users')->insert([
            'name' => 'Norangel',
            'lastname' => 'Morales',
            'idcard' => '20568269',
            'sex' => 'f',
            'birtdate' => '1991-01-17',
            'phone' => '02682529835',
            'cellphone' => '04243677315',
            'address' => 'Coro',
            'email' => 'ncmc@gmail.com',
            'password' => bcrypt('123123'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            ]);

        DB::table('users')->insert([
            'name' => 'Orianny',
            'lastname' => 'Davila',
            'idcard' => '20297718',
            'sex' => 'f',
            'birtdate' => '1990-08-25',
            'cellphone' => '04127893278',
            'address' => 'Coro',
            'email' => 'orianny10@gmail.com',
            'password' => bcrypt('123123'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            ]);

        DB::table('users')->insert([
            'name' => 'Marianna',
            'lastname' => 'Torres',
            'idcard' => '20568323',
            'sex' => 'f',
            'birtdate' => '1990-06-19',
            'cellphone' => '04269605865',
            'address' => 'Coro',
            'email' => 'mcta_19@gmail.com',
            'password' => bcrypt('123123'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            ]);

        DB::table('users')->insert([
            'name' => 'Elias',
            'lastname' => 'Diaz',
            'idcard' => '20000000',
            'sex' => 'm',
            'birtdate' => '1991-08-03',
            'cellphone' => '04269089784',
            'address' => 'Caracas',
            'email' => 'eliasdiazpiano@gmail.com',
            'password' => bcrypt('123123'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            ]);
    }
}