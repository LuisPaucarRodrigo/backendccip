<?php

namespace Database\Seeders;

use App\Models\Typepension;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class aporttype extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'type' => 'HABITAT',
                'val-csf' => 1.47,
                'val-pri-seg' => 1.84,
                'val-apor-obli' => 10.00,
            ],
            [
                'type' => 'INTEGRA',
                'val-csf' => 1.55,
                'val-pri-seg' => 1.84,
                'val-apor-obli' => 10.00,
            ],
            [
                'type' => 'PRIMA',
                'val-csf' => 1.60,
                'val-pri-seg' => 1.84,
                'val-apor-obli' => 10.00,
            ],
            [
                'type' => 'PROFUTURO',
                'val-csf' => 1.69,
                'val-pri-seg' => 1.84,
                'val-apor-obli' => 10.00,
            ],
            [
                'type' => 'HABITATMX',
                'val-csf' => 0,
                'val-pri-seg' => 1.84,
                'val-apor-obli' => 10.00,
            ],
            [
                'type' => 'INTEGRAMX',
                'val-csf' => 0,
                'val-pri-seg' => 1.84,
                'val-apor-obli' => 10.00,
            ],
            [
                'type' => 'PRIMAMX',
                'val-csf' => 0,
                'val-pri-seg' => 1.84,
                'val-apor-obli' => 10.00,
            ],
            [
                'type' => 'PROFUTUROMX',
                'val-csf' => 0,
                'val-pri-seg' => 1.84,
                'val-apor-obli' => 10.00,
            ],
        ];
        Typepension::insert($data);
    }
}
