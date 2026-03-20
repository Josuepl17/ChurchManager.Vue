<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caixa extends Model
{
    use HasFactory;
    protected $table = 'caixas';
    protected $fillable = ['id', 'dataini', 'datafi', 'totalofertas', 'totaldespesas', 'totaldizimos', 'saldo', 'empresa_id', 'user_id'];

    public function empresas(){
        return $this->belongsTo(Empresa::class);// pertence a
    }
}
