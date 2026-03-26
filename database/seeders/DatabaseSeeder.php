<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use App\Models\SkillCategory;
use App\Models\Skill;
use App\Models\Achievement;
use App\Models\Project;
use App\Models\ToolCategory;
use App\Models\Tool;
use App\Models\Link;
use App\Models\Experience;
use App\Models\Education;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Dede Juniar Putra',
            'email' => 'dedejuniarputra99@gmail.com',
            'password' => bcrypt('0315'),
        ]);

        // Profile
        Profile::create([
            'name' => 'Dede Juniar Putra',
            'tagline' => 'Building Cool Stuff',
            'bio' => 'A passionate developer dedicated to building impactful digital solutions. I specialize in developing scalable web applications using a modern tech stack, primarily Laravel, Vue.js, and MySQL.',
            'long_bio' => 'My focus is on crafting software architecture that is well-structured, maintainable, and aligned with business goals. I combine technical expertise with proactive communication to ensure every project delivers logical clarity and a meaningful real-world impact.',
            'location' => 'Lampung, Indonesia',
            'status' => 'Onsite',
            'email' => 'dedejuniarputra99@gmail.com',
            'github' => 'https://github.com/dedejuniarputra',
            'linkedin' => 'https://linkedin.com/in/dedejuniarputra',
            'instagram' => 'https://instagram.com/dedejuniarputra',
        ]);

        // Experience (Career)
        Experience::create([
            'company' => 'Pt. Affan Technology Indonesia (Parto.id)',
            'title' => 'Backend Golang Developer',
            'location' => 'Jambi, Indonesia',
            'start_date' => 'Jul 2025',
            'end_date' => 'Sep 2025',
            'duration' => '2 Months',
            'type' => 'Internship',
            'mode' => 'Hybrid',
            'responsibilities' => [
                'Developed and maintained backend services using Golang for Parto.id\'s internal attendance application.',
                'Implemented efficient data handling and secure API integrations to support daily attendance workflows.',
                'Collaborated with frontend and product teams to ensure smooth functionality and seamless user experience.'
            ],
            'learnings' => [
                'Deepened understanding of Go\'s concurrency model and Clean Architecture within a production environment.',
                'Gained hands-on experience in implementing Agile Scrum methodologies to streamline development workflows.',
                'Learned to collaborate effectively within a professional development team to achieve collective project goals.'
            ],
            'impact' => [
                'Developed core APIs for essential functionalities, including clock-in/clock-out systems, leave management (listing and requesting), and employee profile management (GET/UPDATE).',
                'Improved system reliability for internal tools by optimizing database queries for employee records and leave history.'
            ],
            'order' => 1
        ]);

        Experience::create([
            'company' => 'Himpunan Mahasiswa Sistem Informasi Universitas Jambi (HIMASI UNJA)',
            'title' => 'Head of Technology in the Research and Technology Division',
            'location' => 'Jambi, Indonesia',
            'start_date' => 'Dec 2024',
            'end_date' => 'Dec 2025',
            'duration' => '1 year',
            'type' => 'Part-time',
            'mode' => 'Onsite',
            'responsibilities' => [
                'Managed and coordinated technology-related projects within the Research and Technology division.',
                'Led a team to conduct research on emerging technologies and their potential applications.',
                'Organized technical workshops and seminars to enhance digital literacy among students.'
            ],
            'learnings' => [
                'Gained strong leadership and organizational management experience in a technical community.',
                'Improved strategic planning and project coordination skills within a professional society.',
                'Deepened understanding of how to translate research into practical community projects.'
            ],
            'impact' => [
                'Successfully delivered 3+ major technical workshops with high student engagement.',
                'Improved division\'s project management workflow, increasing overall efficiency by 30%.',
                'Established a mentorship program for new members within the technology division.'
            ],
            'order' => 2
        ]);

        // Education
        Education::create([
            'institution' => 'Universitas Jambi',
            'degree' => 'Bachelor\'s degree',
            'field_of_study' => 'Information Systems, (S.Kom)',
            'gpa' => '3.80/4.00',
            'start_date' => '2022',
            'end_date' => '2026',
            'location' => 'Jambi, Indonesia',
            'order' => 1
        ]);

        Education::create([
            'institution' => 'SMAN 1 Tanjung Jabung Barat',
            'degree' => 'Senior High School',
            'field_of_study' => 'Science',
            'start_date' => '2019',
            'end_date' => '2022',
            'location' => 'Tanjung Jabung Barat, Jambi, Indonesia',
            'order' => 2
        ]);

        // Skill Categories
        $categories = [
            ['name' => 'All', 'slug' => 'all', 'order' => 0],
            ['name' => 'Frontend', 'slug' => 'frontend', 'order' => 1],
            ['name' => 'Backend', 'slug' => 'backend', 'order' => 2],
            ['name' => 'Database', 'slug' => 'database', 'order' => 3],
            ['name' => 'Mobile', 'slug' => 'mobile', 'order' => 4],
            ['name' => 'Tools', 'slug' => 'tools', 'order' => 5],
        ];

        foreach ($categories as $cat) {
            SkillCategory::create($cat);
        }

        $frontendId = SkillCategory::where('slug', 'frontend')->first()->id;
        $backendId = SkillCategory::where('slug', 'backend')->first()->id;
        $dbId = SkillCategory::where('slug', 'database')->first()->id;
        $mobileId = SkillCategory::where('slug', 'mobile')->first()->id;
        $toolsId = SkillCategory::where('slug', 'tools')->first()->id;

        $skills = [
            // Frontend
            ['skill_category_id' => $frontendId, 'name' => 'HTML', 'icon' => 'devicon-html5-plain', 'color' => '#e34f26', 'order' => 1],
            ['skill_category_id' => $frontendId, 'name' => 'CSS', 'icon' => 'devicon-css3-plain', 'color' => '#264de4', 'order' => 2],
            ['skill_category_id' => $frontendId, 'name' => 'JavaScript', 'icon' => 'devicon-javascript-plain', 'color' => '#f7df1e', 'order' => 3],
            ['skill_category_id' => $frontendId, 'name' => 'TailwindCSS', 'icon' => 'devicon-tailwindcss-plain', 'color' => '#06b6d4', 'order' => 4],
            ['skill_category_id' => $frontendId, 'name' => 'Vue.js', 'icon' => 'devicon-vuejs-plain', 'color' => '#42b883', 'order' => 5],
            ['skill_category_id' => $frontendId, 'name' => 'Bootstrap', 'icon' => 'devicon-bootstrap-plain', 'color' => '#7952b3', 'order' => 6],
            // Backend
            ['skill_category_id' => $backendId, 'name' => 'PHP', 'icon' => 'devicon-php-plain', 'color' => '#777bb4', 'order' => 1],
            ['skill_category_id' => $backendId, 'name' => 'Laravel', 'icon' => 'devicon-laravel-plain', 'color' => '#ff2d20', 'order' => 2],
            ['skill_category_id' => $backendId, 'name' => 'Node.js', 'icon' => 'devicon-nodejs-plain', 'color' => '#339933', 'order' => 3],
            // Database
            ['skill_category_id' => $dbId, 'name' => 'MySQL', 'icon' => 'devicon-mysql-plain', 'color' => '#4479a1', 'order' => 1],
            ['skill_category_id' => $dbId, 'name' => 'PostgreSQL', 'icon' => 'devicon-postgresql-plain', 'color' => '#336791', 'order' => 2],
            // Mobile
            ['skill_category_id' => $mobileId, 'name' => 'Android', 'icon' => 'devicon-android-plain', 'color' => '#3ddc84', 'order' => 1],
            // Tools
            ['skill_category_id' => $toolsId, 'name' => 'Git', 'icon' => 'devicon-git-plain', 'color' => '#f05032', 'order' => 1],
            ['skill_category_id' => $toolsId, 'name' => 'GitHub', 'icon' => 'devicon-github-original', 'color' => '#ffffff', 'order' => 2],
            ['skill_category_id' => $toolsId, 'name' => 'VS Code', 'icon' => 'devicon-vscode-plain', 'color' => '#007acc', 'order' => 3],
            ['skill_category_id' => $toolsId, 'name' => 'Docker', 'icon' => 'devicon-docker-plain', 'color' => '#2496ed', 'order' => 4],
            ['skill_category_id' => $toolsId, 'name' => 'NPM', 'icon' => 'devicon-npm-original-wordmark', 'color' => '#cb3837', 'order' => 5],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // Achievements
        $achievements = [
            [
                'title' => 'Laravel Certification',
                'description' => 'Certified Laravel Developer from official Laravel certification program.',
                'issuer' => 'Laravel',
                'date' => '2024-01-15',
                'order' => 1,
            ],
            [
                'title' => 'Web Development Bootcamp',
                'description' => 'Completed intensive full-stack web development bootcamp covering modern web technologies.',
                'issuer' => 'Dicoding Indonesia',
                'date' => '2023-06-20',
                'order' => 2,
            ],
            [
                'title' => 'Best Developer Award',
                'description' => 'Recognized as the best developer in university hackathon competition.',
                'issuer' => 'University of Technology',
                'date' => '2023-11-10',
                'order' => 3,
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }

        // Projects
        $projects = [
            [
                'title' => 'Portfolio Website',
                'description' => 'Personal portfolio website built with Laravel 12 and Tailwind CSS.',
                'long_description' => 'A modern portfolio website with an admin panel for content management. Features include dark theme, animations, and full CRUD for all sections.',
                'tech_stack' => ['Laravel', 'Tailwind CSS', 'MySQL', 'Alpine.js'],
                'github_url' => 'https://github.com/dedejuniarputra/portfolio',
                'status' => 'completed',
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'title' => 'E-Commerce Platform',
                'description' => 'Full-featured e-commerce platform with product management, cart, and payment integration.',
                'long_description' => 'Built a complete online store with product catalog, shopping cart, user authentication, order management, and payment gateway integration.',
                'tech_stack' => ['Laravel', 'Vue.js', 'MySQL', 'Stripe'],
                'github_url' => 'https://github.com/dedejuniarputra/ecommerce',
                'status' => 'completed',
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'title' => 'Task Management App',
                'description' => 'Collaborative task management application with real-time updates.',
                'long_description' => 'A kanban-style task management app with team collaboration features, drag-and-drop interface, and real-time notifications.',
                'tech_stack' => ['Laravel', 'Vue.js', 'MySQL'],
                'github_url' => 'https://github.com/dedejuniarputra/taskmanager',
                'status' => 'in-progress',
                'is_featured' => false,
                'order' => 3,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }

        // Tool Categories
        $toolCategories = [
            ['name' => 'Editor & Terminal', 'slug' => 'editor', 'icon' => '💻', 'order' => 1],
            ['name' => 'Applications', 'slug' => 'apps', 'icon' => '📱', 'order' => 2],
            ['name' => 'Hardware', 'slug' => 'hardware', 'icon' => '🖥️', 'order' => 3],
            ['name' => 'Design', 'slug' => 'design', 'icon' => '🎨', 'order' => 4],
        ];

        foreach ($toolCategories as $tc) {
            ToolCategory::create($tc);
        }

        $editorId = ToolCategory::where('slug', 'editor')->first()->id;
        $appsId = ToolCategory::where('slug', 'apps')->first()->id;
        $hardwareId = ToolCategory::where('slug', 'hardware')->first()->id;
        $designId = ToolCategory::where('slug', 'design')->first()->id;

        $tools = [
            ['tool_category_id' => $editorId, 'name' => 'VS Code', 'description' => 'My primary code editor with extensions for Laravel, Vue, and more.', 'url' => 'https://code.visualstudio.com', 'order' => 1],
            ['tool_category_id' => $editorId, 'name' => 'Windows Terminal', 'description' => 'Modern terminal with tabs and customization.', 'url' => 'https://github.com/microsoft/terminal', 'order' => 2],
            ['tool_category_id' => $editorId, 'name' => 'Laragon', 'description' => 'Portable, fast and powerful local development environment for Windows.', 'url' => 'https://laragon.org', 'order' => 3],
            ['tool_category_id' => $appsId, 'name' => 'Postman', 'description' => 'API testing and development platform.', 'url' => 'https://postman.com', 'order' => 1],
            ['tool_category_id' => $appsId, 'name' => 'TablePlus', 'description' => 'Database management tool for MySQL, PostgreSQL, and more.', 'url' => 'https://tableplus.com', 'order' => 2],
            ['tool_category_id' => $appsId, 'name' => 'GitHub Desktop', 'description' => 'Simplified git workflow application.', 'url' => 'https://desktop.github.com', 'order' => 3],
            ['tool_category_id' => $hardwareId, 'name' => 'Custom PC', 'description' => 'Intel i5 processor, 16GB RAM, GTX 1060 GPU.', 'order' => 1],
            ['tool_category_id' => $designId, 'name' => 'Figma', 'description' => 'UI/UX design and prototyping tool.', 'url' => 'https://figma.com', 'order' => 1],
            ['tool_category_id' => $designId, 'name' => 'Canva', 'description' => 'Quick design tool for social media and presentations.', 'url' => 'https://canva.com', 'order' => 2],
        ];

        foreach ($tools as $tool) {
            Tool::create($tool);
        }

        // Links
        $links = [
            ['title' => 'GitHub', 'url' => 'https://github.com/dedejuniarputra', 'icon' => 'github', 'description' => 'Check out my code repositories', 'category' => 'social', 'order' => 1],
            ['title' => 'LinkedIn', 'url' => 'https://linkedin.com/in/dedejuniarputra', 'icon' => 'linkedin', 'description' => 'Connect with me professionally', 'category' => 'social', 'order' => 2],
            ['title' => 'Instagram', 'url' => 'https://instagram.com/dedejuniarputra', 'icon' => 'instagram', 'description' => 'Follow my daily life', 'category' => 'social', 'order' => 3],
            ['title' => 'Portfolio', 'url' => 'http://localhost', 'icon' => 'globe', 'description' => 'My portfolio website', 'category' => 'resource', 'order' => 4],
        ];

        foreach ($links as $link) {
            Link::create($link);
        }
    }
}
