<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Hashidable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Estudiante extends Model
{
  use HasFactory, Hashidable, SoftDeletes;

  protected $appends = ['hashed_id'];

  protected $primaryKey = "idu";

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

  protected $attributes = [
      'activo' => 1
  ];

  protected $table = 'usuarios';


  public function tipoUsuario(){
      return $this->belongsTo( TipoDeUsuario::class, 'idtu', 'idtu');
  }

  public function grupo(){
      return $this->belongsTo( Grupo::class, 'idg', 'idg' );
  }

  public function solicitudes(){
      return $this->hasMany( Solicitud::class );
  }

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

  public function getHashedIdAttribute($value)
  {
      return \Hashids::connection(get_called_class())->encode($this->getKey());
  }
}
