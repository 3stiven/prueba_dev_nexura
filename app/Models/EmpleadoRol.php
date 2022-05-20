<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleadoRol extends Model
{
    use HasFactory;
    protected $table = 'empleado_rol';
    protected $primarykey = 'id';
    protected $fillable = ['empleado_id','rol_id'];

    public function rolName()
    {
        return $this->hasMany(Rol::class, 'id', 'rol_id');
    }

}
