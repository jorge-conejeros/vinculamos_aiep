<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoIniciativa extends Model
{
    use HasFactory;

    protected $table = 'tipo_iniciativa';

    public $timestamps = false;

    protected $fillable = [
        'tmec_codigo',
        'tmec_nombre',
        'tmec_visible',
        'tmec_creado',
        'tmec_actualizado',
        'tmec_nickname_mod',
        'tmec_rol_mod',
    ];
}