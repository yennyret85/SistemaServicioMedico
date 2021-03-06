<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(SpecialtiesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UserHasRolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesHasPermissionsTableSeeder::class);
        $this->call(MedicinesTableSeeder::class);
    }
}
