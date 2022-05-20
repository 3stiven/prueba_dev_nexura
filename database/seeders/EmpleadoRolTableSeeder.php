<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmpleadoRolTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('empleado_rol')->delete();
        
        \DB::table('empleado_rol')->insert(array (
            0 => 
            array (
                'id' => 3,
                'empleado_id' => 3,
                'rol_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 4,
                'empleado_id' => 3,
                'rol_id' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 5,
                'empleado_id' => 3,
                'rol_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 6,
                'empleado_id' => 4,
                'rol_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 7,
                'empleado_id' => 4,
                'rol_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}