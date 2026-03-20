<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membro extends Model
{
    use HasFactory;
    protected $table = 'membros';
    protected $fillable = ['id', 'nome', 'sobrenome', 'funcao', 'endereco', 'telefone', 'empresa_id', 'user_id'];


    public function dizimos()
    {
        return $this->hasMany(Dizimo::class);
    }

    public function empresas()
    {
        return $this->belongsTo(Empresa::class); // pertence a
    }


}
