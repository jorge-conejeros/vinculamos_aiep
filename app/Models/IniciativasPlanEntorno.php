<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciativasPlanEntorno extends Model
{
    use HasFactory;

    protected $table = 'viga_iniciativas_plan_entorno';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_iniciativa',
        'id_entorno',
        'fecha_creacion'
    ];
}
