<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\ModuleVideo;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $m1 = Module::create([
            'title' => 'Modul 1',
            'subtitle' => 'Dasar Pemrograman Web (Pengenalan HTML5 & CSS3)',
            'order' => 1,
            'description' => 'Fase ini adalah fondasi mutlak. Sebelum menyentuh logika, pengguna harus paham mengenai cara membuat struktur halaman web dasar dan mewarnainya.',
        ]);

        ModuleVideo::insert([
            ['module_id' => $m1->id, 'title' => 'HTML Dasar : Pendahuluan HTML', 'youtube_id' => 'NBZ9Ro6UKV8', 'order' => 1],
            ['module_id' => $m1->id, 'title' => 'Belajar Web Dasar [HTML] - Apa itu HTML', 'youtube_id' => 'wriGST3vp5M', 'order' => 2],
            ['module_id' => $m1->id, 'title' => 'Belajar Web Dasar [CSS] - Apa Itu CSS', 'youtube_id' => 'AQOBN9XByf0', 'order' => 3],
        ]);

        $m2 = Module::create([
            'title' => 'Modul 2',
            'subtitle' => 'Interaktivitas Web (Dasar JavaScript)',
            'order' => 2,
            'description' => 'Setelah memiliki tampilan, sebuah website harus bisa "hidup" dan interaktif. Pada modul ini, materi bergeser pada pengenalan algoritma, variabel, dan manipulasi elemen web (DOM).',
        ]);

        ModuleVideo::insert([
            ['module_id' => $m2->id, 'title' => 'Belajar Dasar Pemrograman Javascript 1 Jam', 'youtube_id' => 'mD6uSGSjgr4', 'order' => 1],
            ['module_id' => $m2->id, 'title' => 'Belajar Javascript [Dasar] - Apa itu Javascript?', 'youtube_id' => 'sNLadea-tLU', 'order' => 2],
        ]);

        $m3 = Module::create([
            'title' => 'Modul 3',
            'subtitle' => 'Desain Web Responsif & Modern (Tailwind CSS)',
            'order' => 3,
            'description' => 'Mengingat PahamDulu menggunakan Tailwind CSS, akan sangat menarik jika modul selanjutnya mengajarkan para siswa cara membuat UI/UX menggunakan framework styling ini.',
        ]);

        ModuleVideo::insert([
            ['module_id' => $m3->id, 'title' => 'Apa itu Tailwind CSS? | Belajar Tailwind CSS', 'youtube_id' => 'z3slaXqmkT0', 'order' => 1],
            ['module_id' => $m3->id, 'title' => 'Tutorial Tailwind CSS 4.0', 'youtube_id' => 'VklI5-WvCCc', 'order' => 2],
        ]);
    }
}
