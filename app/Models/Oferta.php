<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;
    protected $table = 'ofertas';
    protected $fillable = ['nome', 'datereg', 'valor', 'id' , 'user_id', 'empresa_id'];



    public function empresas(){
        return $this->belongsTo(Empresa::class);// pertence a
    }

  

    
    
}
