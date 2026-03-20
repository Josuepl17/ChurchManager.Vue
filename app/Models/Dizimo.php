<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dizimo extends Model
{
    use HasFactory;
    protected $table = 'dizimos';
    protected $fillable = ['id', 'nome', 'datereg', 'valor', 'user_id', 'empresa_id', 'membro_id'];


    public function membros()
    {
        return $this->belongsTo(Membro::class);
    }

    public function empresas(){
        return $this->belongsTo(Empresa::class);// pertence a
    }
}
