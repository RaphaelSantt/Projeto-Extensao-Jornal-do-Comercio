<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model {
    use HasFactory;
    protected $fillable = ['nome', 'codigo', 'setor'];

    public function analises() {
        return $this->hasMany(Analise::class);
    }
}
