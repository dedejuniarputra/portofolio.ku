<?php

use App\Models\Skill;
use App\Models\SkillCategory;

$categories = [
    ['name' => 'Utama', 'slug' => 'utama', 'order' => 1],
    ['name' => 'Frontend', 'slug' => 'frontend', 'order' => 2],
    ['name' => 'Backend', 'slug' => 'backend', 'order' => 3],
    ['name' => 'Mobile', 'slug' => 'mobile', 'order' => 4],
    ['name' => 'Database', 'slug' => 'database', 'order' => 5],
    ['name' => 'Tools', 'slug' => 'tools', 'order' => 6],
];

foreach ($categories as $cat) {
    SkillCategory::updateOrCreate(['slug' => $cat['slug']], $cat);
}

$catMap = SkillCategory::all()->pluck('id', 'slug')->toArray();

$skills = [
    // Utama
    ['name' => 'HTML', 'category' => 'utama', 'color' => '#e34f26', 'icon' => 'devicon-html5-plain'],
    ['name' => 'CSS', 'category' => 'utama', 'color' => '#1572b6', 'icon' => 'devicon-css3-plain'],
    ['name' => 'JavaScript', 'category' => 'utama', 'color' => '#f7df1e', 'icon' => 'devicon-javascript-plain'],
    ['name' => 'PHP', 'category' => 'utama', 'color' => '#777bb4', 'icon' => 'devicon-php-plain'],
    ['name' => 'Laravel', 'category' => 'utama', 'color' => '#ff2d20', 'icon' => 'devicon-laravel-plain'],
    
    // Frontend
    ['name' => 'React.js', 'category' => 'frontend', 'color' => '#61dafb', 'icon' => 'devicon-react-original'],
    ['name' => 'Next.js', 'category' => 'frontend', 'color' => '#ffffff', 'icon' => 'devicon-nextjs-original'],
    ['name' => 'TailwindCSS', 'category' => 'frontend', 'color' => '#06b6d4', 'icon' => 'devicon-tailwindcss-plain'],
    ['name' => 'Bootstrap', 'category' => 'frontend', 'color' => '#7952b3', 'icon' => 'devicon-bootstrap-plain'],
    ['name' => 'TypeScript', 'category' => 'frontend', 'color' => '#3178c6', 'icon' => 'devicon-typescript-plain'],
    ['name' => 'Vite', 'category' => 'frontend', 'color' => '#646cff', 'icon' => 'devicon-vitejs-plain'],
    ['name' => 'Astro.js', 'category' => 'frontend', 'color' => '#ff5d01', 'icon' => 'devicon-astro-plain'],
    ['name' => 'Shadcn UI', 'category' => 'frontend', 'color' => '#ffffff', 'icon' => 'devicon-chrome-plain'], // Fallback icon
    ['name' => 'Redux', 'category' => 'frontend', 'color' => '#764abc', 'icon' => 'devicon-redux-original'],
    ['name' => 'TanStack', 'category' => 'frontend', 'color' => '#ffab00', 'icon' => 'devicon-react-original'], // Custom color
    ['name' => 'Axios', 'category' => 'frontend', 'color' => '#5a29e4', 'icon' => 'devicon-javascript-plain'],
    ['name' => 'Zod', 'category' => 'frontend', 'color' => '#274d82', 'icon' => 'devicon-typescript-plain'],
    ['name' => 'Framer Motion', 'category' => 'frontend', 'color' => '#ff0055', 'icon' => 'devicon-framermotion-original'],

    // Backend
    ['name' => 'Node.js', 'category' => 'backend', 'color' => '#339933', 'icon' => 'devicon-nodejs-plain'],
    ['name' => 'Express.js', 'category' => 'backend', 'color' => '#ffffff', 'icon' => 'devicon-express-original'],
    ['name' => 'Go', 'category' => 'backend', 'color' => '#00add8', 'icon' => 'devicon-go-original-wordmark'],
    ['name' => 'Gin Gonic', 'category' => 'backend', 'color' => '#00add8', 'icon' => 'devicon-go-plain'],
    ['name' => 'Swagger', 'category' => 'backend', 'color' => '#85ea2d', 'icon' => 'devicon-swagger-plain'],
    ['name' => 'Prisma', 'category' => 'backend', 'color' => '#2d3748', 'icon' => 'devicon-prisma-original'],
    ['name' => 'NextAuth.js', 'category' => 'backend', 'color' => '#ffffff', 'icon' => 'devicon-nextjs-plain'],

    // Mobile
    ['name' => 'Kotlin', 'category' => 'mobile', 'color' => '#7f52ff', 'icon' => 'devicon-kotlin-plain'],
    ['name' => 'Jetpack Compose', 'category' => 'mobile', 'color' => '#4285f4', 'icon' => 'devicon-android-plain'],

    // Database
    ['name' => 'PostgreSql', 'category' => 'database', 'color' => '#4169e1', 'icon' => 'devicon-postgresql-plain'],
    ['name' => 'MySql', 'category' => 'database', 'color' => '#4479a1', 'icon' => 'devicon-mysql-plain'],
    ['name' => 'Firebase', 'category' => 'database', 'color' => '#ffca28', 'icon' => 'devicon-firebase-plain'],
    ['name' => 'Supabase', 'category' => 'database', 'color' => '#3ecf8e', 'icon' => 'devicon-supabase-plain'],

    // Tools
    ['name' => 'Docker', 'category' => 'tools', 'color' => '#2496ed', 'icon' => 'devicon-docker-plain'],
    ['name' => 'NPM', 'category' => 'tools', 'color' => '#cb3837', 'icon' => 'devicon-npm-original-wordmark'],
    ['name' => 'Yarn', 'category' => 'tools', 'color' => '#2c8ebb', 'icon' => 'devicon-yarn-plain'],
    ['name' => 'Bun', 'category' => 'tools', 'color' => '#ffffff', 'icon' => 'devicon-bun-plain'],
    ['name' => 'Github', 'category' => 'tools', 'color' => '#ffffff', 'icon' => 'devicon-github-original'],
];

// Optional: Clear existing skills if you want an exact match, but updateOrCreate is safer
// Skill::truncate(); 

foreach ($skills as $s) {
    Skill::updateOrCreate(
        ['name' => $s['name']],
        [
            'skill_category_id' => $catMap[$s['category']] ?? null,
            'color' => $s['color'],
            'icon' => $s['icon'],
            'order' => array_search($s, $skills)
        ]
    );
}

echo "Skills synchronized successfully.\n";
