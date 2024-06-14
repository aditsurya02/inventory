<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            ['deskripsi' => 'Pendingin Ruang',
             'kategori' => 'M'],
             ['deskripsi' => 'Personal Komputer',
             'kategori' => 'M'],
             ['deskripsi' => 'Laptop',
             'kategori' => 'M'],
             ['deskripsi' => 'Speaker Active',
             'kategori' => 'M'],
             ['deskripsi' => 'Scanner',
             'kategori' => 'M'],
             ['deskripsi' => 'Printer',
             'kategori' => 'M'],
             ['deskripsi' => 'Projector',
             'kategori' => 'M'],
             ['deskripsi' => 'Projector Screen',
             'kategori' => 'M'],
             ['deskripsi' => 'Mesin Bor',
             'kategori' => 'M'],
             ['deskripsi' => 'Crimping Tools',
             'kategori' => 'A'],
             ['deskripsi' => 'Obeng',
             'kategori' => 'A'],
             ['deskripsi' => 'Tang',
             'kategori' => 'A'],
             ['deskripsi' => 'Alat Ukur',
             'kategori' => 'A'],
             ['deskripsi' => 'Solder',
             'kategori' => 'A'],
             ['deskripsi' => 'Konektor Jaringan | Bahan Praktik',
             'kategori' => 'BHP'],
             ['deskripsi' => 'Kabel Jumper | Bahan Praktik',
             'kategori' => 'BHP'],
             ['deskripsi' => 'Perangkat Jaringan | Bahan Praktik',
             'kategori' => 'BTHP'],
             ['deskripsi' => 'Mikrokontroller Board | Bahan Praktik',
             'kategori' => 'BTHP'],
             ['deskripsi' => 'Mikrokontroller Module | Bahan Praktik',
             'kategori' => 'BTHP'],
             ['deskripsi' => 'Komponen Elektronika | Bahan Praktik',
             'kategori' => 'BTHP']
        ];

        Kategori::insert($data);
    }
}