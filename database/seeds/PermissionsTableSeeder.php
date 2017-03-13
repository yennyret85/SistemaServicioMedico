<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
/////////////////////---USUARIOS---/////////////////////

    DB::table('permissions')->insert([
        'name' => 'RegistrarPaciente',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'EditarPaciente',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'RegistrarUsuario',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'EditarUsuario',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);
    
    DB::table('permissions')->insert([
        'name' => 'EliminarUsuario',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);
    
/////////////////////---CITAS---/////////////////////

    DB::table('permissions')->insert([
        'name' => 'VerTodasLasCitas',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'VerMisCitas',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'AsignarCita',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'EditarCita',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'CambiarStatusCita',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'CancelarCita',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'ConcluirCita',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'EliminarCita',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

/////////////////////---HISTORIA MEDICA---/////////////////////

    DB::table('permissions')->insert([
        'name' => 'VerHistoriaMedica',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'CrearHistoriaMedica',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'ActualizarHistoriaMedica',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'EliminarHistoriaMedica',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

/////////////////////---RECIPE---/////////////////////

    DB::table('permissions')->insert([
        'name' => 'VerRecipe',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'CrearRecipe',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'ModificarRecipe',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'CambiarStatusRecipe',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

/////////////////////---ROLES---/////////////////////

    DB::table('permissions')->insert([
        'name' => 'CrearRol',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'EditarRol',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'EliminarRol',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

/////////////////////---PERMISOS---/////////////////////

    DB::table('permissions')->insert([
        'name' => 'AsignarPermiso',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'CrearPermiso',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'EditarPermiso',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'EliminarPermiso',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    /////////////////////---MEDICINAS---/////////////////////

    DB::table('permissions')->insert([
        'name' => 'CrearMedicina',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'EliminarMedicina',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    /////////////////////---ESPECIALIDADES---/////////////////////

    DB::table('permissions')->insert([
        'name' => 'CrearEspecialidad',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'EditarEspecialidad',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    DB::table('permissions')->insert([
        'name' => 'EliminarEspecialidad',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ]);

    } //33 Permisos
}
