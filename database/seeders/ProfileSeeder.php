<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::create([
             'name' => 'Sufian Mahbub',
             'title' => '10 Years of Experience in Full Stack Development',
             'description' => 'I am a passionate developer with a decade of hands-on experience in building complex web applications. From startups to enterprise solutions, I love solving problems with elegant code.',
             'experience_years' => '10+',
             'projects_completed' => '50+',
             'clients_satisfied' => '20+',
             'image' => 'assets/img.png' // Ensure this matches actual file or placeholder
        ]);
    }
}
