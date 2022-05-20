<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $table = 'empleado';
    protected $primarykey = 'id';
    protected $fillable = ['nombre','email','sexo','area_id','boletin','descripcion','estado'];

    public function area()
    {
        return $this->hasOne(Area::class, 'id', 'area_id');
    }

    public function roles()
    {
        return $this->hasMany(EmpleadoRol::class, 'empleado_id', 'id')->select('empleado_id' ,'rol_id');
    }
}
