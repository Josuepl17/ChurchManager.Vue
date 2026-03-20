<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventoPresenca extends Model
{
    protected $table = 'evento_presenca';
    protected $fillable = ['id',  'evento_id',  'membros_id'];
    use HasFactory;
}
