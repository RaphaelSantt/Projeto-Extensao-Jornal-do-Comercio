<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analise extends Model {
    use HasFactory;
    protected $fillable = ['empresa_id', 'dados_financeiros', 'sentimento_mercado', 'discussoes', 'conteudo_gerado', 'aprovado'];

    protected $casts = [
        'dados_financeiros' => 'array',
        'aprovado' => 'boolean',
        'discussoes' => 'array',
    ];

    public function empresa() {
        return $this->belongsTo(Empresa::class);
    }
}
