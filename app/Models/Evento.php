<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';

    protected $fillable = ['id', 'user_id', 'evento', 'empresa_id', 'presentes', 'faltantes', 'datereg' ];
    use HasFactory;
}
