<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Hashidable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use HasFactory, Hashidable, SoftDeletes;

    protected $appends = ['hashed_id'];

    protected $primaryKey = 'idem';

    protected $fillable = [
        'idem',
        'rfc',
        'nombre',
        'direccion',
        'ciudad',
        'pagina_web',
        'tipo',
        'tamaño',
        'activo',
        'contacto',
        'correo',
        'telefono'
    ];


    protected $table = 'empresas';

    public function asesoresIndustriales(){
        return $this->hasMany( AsesorIndustrial::class );
    }

    public function getHashedIdAttribute($value)
    {
        return \Hashids::connection(get_called_class())->encode($this->getKey());
    }
}
