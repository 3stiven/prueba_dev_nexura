<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Cursos;
use App\Models\CursosAsignados;
use App\Models\Empleado;
use App\Models\EmpleadoRol;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    //
   

    public function createEmpleado(Request $request)
    {
       
        // DB::beginTransaction();

        // try {
        //     DB::commit();
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     $data['respuesta'] = [
        //         'codigo' => 404,
        //         'icon' => 'mdi-alert-octagon',
        //         'color' => 'error',
        //         'text' => $e->getMessage(),
        //         'line' => $e->getLine(),
        //         'file' => $e->getFile(),
        //     ];
        //     return $data;
        // }

        $request->validate([
            'correo' =>  'unique:users,email',

        ]);

        $roles = $request->informacion['selected_roles'];


        $create = Empleado::create([
            'nombre' => $request->informacion['nombre'],
            'email' => $request->informacion['email'],
            'sexo' => $request->informacion['sexo'],
            'area_id' => $request->informacion['area'],
            'boletin' => $request->informacion['boletin'],
            'descripcion' => $request->informacion['descripcion'],
        ]);

        if($create){
            $latest_id = $create->id;

            foreach ($roles as $key => $valueRol) {
                # code...
                $asignarRol = EmpleadoRol::create([
                    'empleado_id' => $latest_id ,
                    'rol_id' => $valueRol,
                ]);
            }
            // dd($latest_id);

            return response()->json(['responseText' => 'Usuario Registrado Correstamente','response' => 200 , 'succes' => 'ok'], 200);

        }

    }

    public function getRoles(){
        $getRoles=Rol::get();
        return $getRoles;
    }

    public function getAreas(){
        $getAreas=Area::get();
        return $getAreas;
    }

    public function getEmpleados(){

        DB::beginTransaction();

        try {

            $obtenerEmpleados = Empleado::with('area:id,nombre','roles.rolName:id,nombre')->where('estado','Activo')->get();

            if($obtenerEmpleados  == null){
                return response()->json(['responseText' => 'No hay empleados registrados','response' => 500 ]);
            } else {
                return $obtenerEmpleados;
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $data['respuesta'] = [
                'codigo' => 404,
                'icon' => 'mdi-alert-octagon',
                'color' => 'error',
                'text' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ];
            return $data;
        }

    }

    public function deleteEmpleado(Request $request){
        DB::beginTransaction();

        try {
            $eliminarEmpleado = Empleado::where('id',$request->identifier)->update(['estado' => 'Eliminado']);

            if($eliminarEmpleado ){
                $delete =  response()->json(['responseText' => 'Empleado Eliminado Correstamente','response' => 200 , 'succes' => 'ok'], 200);
            }
            DB::commit();
            return $delete;
        } catch (\Exception $e) {
            DB::rollback();
            $data['respuesta'] = [
                'codigo' => 404,
                'icon' => 'mdi-alert-octagon',
                'color' => 'error',
                'text' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ];
            return $data;
        }
    }

    public function updateEmpleado(Request $request){
        

        try {
            $eliminarEmpleado = Empleado::where('id',$request->informacion['id'])
            ->update(['nombre' => $request->informacion['nombre'],
            'email' => $request->informacion['email'],
            'sexo' => $request->informacion['sexo'],
            'area_id' => $request->informacion['area_id'],
            'boletin' => $request->informacion['boletin'],
            'descripcion' => $request->informacion['descripcion']]);

            if($eliminarEmpleado ){
                $delete =  response()->json(['responseText' => 'Empleado Actualizado Correstamente','response' => 200 , 'succes' => 'ok'], 200);
            }
            DB::commit();
            return $delete;
        } catch (\Exception $e) {
            DB::rollback();
            $data['respuesta'] = [
                'codigo' => 404,
                'icon' => 'mdi-alert-octagon',
                'color' => 'error',
                'text' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ];
            return $data;
        }


    }

   

}
