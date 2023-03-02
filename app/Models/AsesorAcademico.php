<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesorAcademico extends Model
{
    use HasFactory;

    protected $primaryKey = 'idu';

    protected $fillable = [
        'matricula',
        'foto',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'email',
        'password',
        'activo',
        'sexo',
        'idtu',
        'idg'
    ];

    protected $table = 'usuarios';

    public function getGetFullnameAttribute()
    {
        return "{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}";
    }

    public function getGetStatusAttribute(){
        if($this->activo === 1){
            return strtoupper("Activo");
        }else{
            return strtoupper('Inactivo');
        }
    }

    public function tipoUsuario(){
        return $this->belongsTo( TipoDeUsuario::class, 'idtu' );
    }

    public function solicitudes(){
        return $this->hasMany( Solicitud::class );
    }
}
