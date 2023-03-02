<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Hashidable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitud extends Model
{

    use HasFactory, Hashidable, SoftDeletes;

    protected $primaryKey = 'ids';

    protected $fillable = [
        'tipo_estancia',
        'fecha_de_inicio',
        'fecha_de_termino',
        'num_horas',
        'nss',
        'nombre_contacto',
        'cargo_contacto',
        'correo_contacto',
        'telefono_contacto',
        'cuatrimestre',
        'observaciones',
        'estatus',
        'activo',
        'idu',
        'idem',
        'idai',
        'idaa'
    ];

    protected $attributes = [
        'estatus' => 0,
        'activo' => 1
    ];

    protected $table = 'solicitudes';

    public function asesorIndustrial(){
        return $this->belongsTo( AsesorIndustrial::class, 'idai', 'idai');
    }

    public function empresa(){
        return $this->belongsTo( Empresa::class, 'idem', 'idem');
    }

    public function estudiante(){
        return $this->belongsTo( Estudiante::class, 'idu', 'idu' );
    }

    public function asesorAcademico(){
        return $this->belongsTo( AsesorAcademico::class, 'idaa', 'idu');
    }

    public function getEstadoActualAttribute(){
        if(!$this->estatus){
            return 'Pendiente';
        }else{
            return 'Aceptado';
        }
    }

    public function getEstadoActualClassesAttribute(){
        if(!$this->estatus){
            return 'text-center p-1 text-white fw-bold rounded bg-warning';
        }else{
            return 'text-center p-1 text-white fw-bold rounded bg-success';
        }
    }

}
