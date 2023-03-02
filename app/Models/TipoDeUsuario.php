<?php

namespace App\Models;

use App\Http\Traits\Hashidable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoDeUsuario extends Model
{
    use HasFactory, SoftDeletes, Hashidable;

    protected $appends = ['hashed_id'];

    protected $primaryKey = "idtu";

    protected $fillable = [
        'nombre',
        'activo'
    ];

    protected $atributes = [
        'activo' => 1
    ];


    protected $table = 'tipo_de_usuarios';

    // public function setNombreAttribute($value)
    // {
    //     $this->attributes['nombre'] = strtoupper($value);
    // }

    public function getActivoAttribute($value)
    {
        return $this->attributes['activo'] = (int)$value;
    }

    public function getHashedIdAttribute($value)
    {
        return \Hashids::connection(get_called_class())->encode($this->getKey());
    }

    public function usuarios(){
        return $this->hasMany(Alumno::class);
    }
}
