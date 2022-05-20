<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmpleadoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('empleado')->delete();
        
        \DB::table('empleado')->insert(array (
            0 => 
            array (
                'id' => 3,
                'nombre' => 'Pedro Pérez',
                'email' => 'pperez@example.co',
                'sexo' => 'M',
                'area_id' => 5,
                'boletin' => 1,
                'descripcion' => 'Hola Mundo',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 4,
                'nombre' => 'Amalia Bayona',
                'email' => 'abayona@example.co',
                'sexo' => 'F',
                'area_id' => 8,
                'boletin' => 0,
                'descripcion' => 'Para contactar a Amalia Bayona, puede escribir al correo electrónico abayona@example.co',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}