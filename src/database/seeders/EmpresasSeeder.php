<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresasSeeder extends Seeder
{
    public function run(): void
    {
        Empresa::updateOrCreate(['codigo' => 'AAPL'], [
            'nome' => 'Apple Inc.',
            'setor' => 'Tecnologia'
        ]);

        Empresa::updateOrCreate(['codigo' => 'PETR4'], [
            'nome' => 'Petrobras PN',
            'setor' => 'Energia'
        ]);

        Empresa::updateOrCreate(['codigo' => 'VALE3'], [
            'nome' => 'Vale S.A.',
            'setor' => 'Mineração'
        ]);
    }
}
