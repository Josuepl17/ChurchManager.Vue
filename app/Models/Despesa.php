<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    use HasFactory;
    protected $table = 'despesas';
    protected $fillable = ['datereg', 'descricao', 'valor', 'user_id', 'empresa_id'];


    public function empresas(){
        return $this->belongsTo(Empresa::class);// pertence a
    }


}
