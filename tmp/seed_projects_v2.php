<?php

use App\Models\Project;
use Illuminate\Support\Facades\Schema;

// Truncate existing projects to start fresh (Optional, but better for consistency with reference)
// Project::truncate(); 

$projects = [
    [
        'title' => 'satriabahari.my.id',
        'description' => 'Personal website & portfolio, built from scratch using Next.js, TypeScript, Tailwind CSS, SWR and Prisma.',
        'long_description' => "A personal developer portfolio and dashboard built with Next.js and TypeScript, aggregating live coding statistics from GitHub, WakaTime, Codewars, and Monkeytype via serverless API routes. Project data is persisted in Supabase PostgreSQL and served with ISR revalidation, with full bilingual support (en/id) via next-intl.\n\nThis project serves as my digital home and a showcase of my technical journey.",
        'image' => 'projects/portfolio.png', // Placeholder or use existing if any
        'tech_stack' => ['Next.js', 'TypeScript', 'Tailwind', 'SWR', 'Supabase', 'PostgreSQL'],
        'demo_url' => 'https://satriabahari.my.id',
        'github_url' => 'https://github.com/satriabahari/portfolio',
        'status' => 'completed',
        'type' => 'Web',
        'category' => 'Proyek Pribadi',
        'is_featured' => true,
        'views_count' => 184,
        'reactions' => ['heart' => 2, 'laugh' => 2, 'web' => 1],
        'order' => 1
    ],
    [
        'title' => 'Presensi Internal System',
        'description' => 'The Presence Internal System is a custom-built attendance tracking backend developed for internal use.',
        'long_description' => "A robust backend system designed to handle internal attendance tracking for a large organization. Built with performance and scalability in mind, it features automated reporting and real-time synchronization.",
        'image' => 'projects/presence.png',
        'tech_stack' => ['Go', 'PostgreSQL'],
        'demo_url' => null,
        'github_url' => 'https://github.com/example/presence',
        'status' => 'completed',
        'type' => 'Web',
        'category' => 'Magang',
        'is_featured' => false,
        'views_count' => 45,
        'reactions' => ['heart' => 2, 'laugh' => 1, 'web' => 1],
        'order' => 2
    ],
    [
        'title' => 'Mobile Banking App',
        'description' => 'A conceptual mobile banking application with focus on clean UI and smooth transitions.',
        'long_description' => "A high-fidelity mobile application prototype for modern banking services. Includes features like real-time transaction monitoring, easy transfers, and biometric authentication.",
        'image' => 'projects/banking.png',
        'tech_stack' => ['React', 'TypeScript', 'Tailwind'],
        'demo_url' => 'https://banking-demo.example.com',
        'github_url' => 'https://github.com/example/banking-app',
        'status' => 'in-progress',
        'type' => 'Mobile',
        'category' => 'Freelance',
        'is_featured' => true,
        'views_count' => 120,
        'reactions' => ['heart' => 15, 'laugh' => 5, 'web' => 3],
        'order' => 3
    ],
];

foreach ($projects as $p) {
    Project::updateOrCreate(
        ['title' => $p['title']],
        $p
    );
}

echo "Projects seeded successfully!\n";
