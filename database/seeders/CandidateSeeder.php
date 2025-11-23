<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    public function run(): void
    {
        Candidate::create([
            'name' => 'Ahmad Rizki',
            'class' => 'XII IPA 1',
            'vision' => 'Mewujudkan OSIS yang kreatif, inovatif, dan berprestasi',
            'mission' => '1. Meningkatkan kegiatan ekstrakurikuler 2. Memperbaiki fasilitas sekolah 3. Mengadakan lomba-lomba akademik dan non-akademik',
            'vote_count' => 0
        ]);

        Candidate::create([
            'name' => 'Siti Aminah',
            'class' => 'XII IPS 2',
            'vision' => 'OSIS yang peduli, aktif, dan religius',
            'mission' => '1. Memperkuat karakter religius 2. Meningkatkan kepedulian sosial 3. Mengoptimalkan program OSIS',
            'vote_count' => 0
        ]);
    }
}
