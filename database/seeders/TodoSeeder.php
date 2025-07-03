<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Todo;

class TodoSeeder extends Seeder
{
    public function run(): void
    {
        $todos = [
            ['title' => 'Bangun pagi', 'is_completed' => true],
            ['title' => 'Sarapan', 'is_completed' => true],
            ['title' => 'Mandi pagi', 'is_completed' => true],
            ['title' => 'Berangkat kerja/sekolah', 'is_completed' => false],
            ['title' => 'Mengerjakan tugas', 'is_completed' => false],
            ['title' => 'Makan siang', 'is_completed' => false],
            ['title' => 'Rapat harian', 'is_completed' => false],
            ['title' => 'Olahraga sore', 'is_completed' => false],
            ['title' => 'Makan malam', 'is_completed' => false],
            ['title' => 'Bersih-bersih rumah', 'is_completed' => false],
            ['title' => 'Membaca buku', 'is_completed' => false],
            ['title' => 'Menonton TV', 'is_completed' => false],
            ['title' => 'Beribadah', 'is_completed' => false],
            ['title' => 'Tidur malam', 'is_completed' => false],
        ];
        foreach ($todos as $todo) {
            Todo::create($todo);
        }
    }
}
