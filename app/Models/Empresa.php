<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $table = 'empresas';
    protected $fillable = ['razao', 'cnpj', 'id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_empresas', 'empresa_id', 'user_id');
    }

    public function membros (){
        return $this->hasMany(Membro::class, 'empresa_id'); // tem muitos
    }

    public function despesas(){
       return $this->hasMany(Despesa::class, 'empresa_id');
    }

    public function ofertas(){
        return $this->hasMany(Oferta::class, 'empresa_id');
    }

    public function dizimos(){
        return $this->hasMany(Dizimo::class, 'empresa_id');
    }

    public function caixas(){
        return $this->hasMany(Caixa::class, 'empresa_id');
    }
 
}
