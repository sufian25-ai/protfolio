<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                "title" => "Quran Learning Platform",
                "description" => "A comprehensive LMS for Quran learning with student dashboards, progress tracking, and family management features.",
                "tech_stack" => ["Laravel", "Vue.js", "MySQL", "Tailwind"],
                "image" => "https://via.placeholder.com/600x400/15151e/00fff5?text=LMS+Project", 
                "live_link" => "#",
                "github_link" => "#"
            ],
            [
                "title" => "E-Commerce Solution",
                "description" => "Full-featured online store with payment gateway integration, inventory management, and admin panel.",
                "tech_stack" => ["React", "Node.js", "MongoDB", "Stripe"],
                "image" => "https://via.placeholder.com/600x400/15151e/8b5cf6?text=E-Commerce",
                "live_link" => "#",
                "github_link" => "#"
            ],
            [
                "title" => "Task Management App",
                "description" => "Real-time collaboration tool for teams to track tasks, share files, and manage projects efficiently.",
                "tech_stack" => ["Vue.js", "Firebase", "Vuex"],
                "image" => "https://via.placeholder.com/600x400/15151e/ff006e?text=Task+App",
                "live_link" => "#",
                "github_link" => "#"
            ],
            [
                "title" => "AI Content Generator",
                "description" => "SAAS application using OpenAI API to generate marketing copy and blog posts automatically.",
                "tech_stack" => ["Next.js", "OpenAI API", "PostgreSQL"],
                "image" => "https://via.placeholder.com/600x400/15151e/00fff5?text=AI+Generator",
                "live_link" => "#",
                "github_link" => "#"
            ],
            [
                "title" => "Real Estate Portal",
                "description" => "Property listing platform with advanced search filters, map integration, and virtual tours.",
                "tech_stack" => ["Django", "PostGIS", "React"],
                "image" => "https://via.placeholder.com/600x400/15151e/8b5cf6?text=Real+Estate",
                "live_link" => "#",
                "github_link" => "#"
            ],
            [
                "title" => "Health Tracker Dashboard",
                "description" => "Mobile-first web app for tracking fitness goals, diet, and health metrics with visualization.",
                "tech_stack" => ["React Native", "Node.js", "Express"],
                "image" => "https://via.placeholder.com/600x400/15151e/ff006e?text=Health+App",
                "live_link" => "#",
                "github_link" => "#"
            ]
        ];

        foreach ($projects as $project) {
            \App\Models\Project::create($project);
        }
    }
}
