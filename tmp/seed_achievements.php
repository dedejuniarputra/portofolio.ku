<?php

use App\Models\Achievement;

$achievements = Achievement::all();

if ($achievements->count() > 0) {
    $data = [
        [
            'credential_id' => '196/EKS/HCLGA/ATI/VIII/2025',
            'type' => 'Profesional',
            'category' => 'Backend',
        ],
        [
            'credential_id' => 'E-book Petunjuk Pro',
            'type' => 'Course',
            'category' => 'Freelance',
        ],
        [
            'credential_id' => '81P2LGL38ZOY',
            'type' => 'Course',
            'category' => 'Mobile',
        ],
    ];

    foreach ($achievements as $index => $achievement) {
        if (isset($data[$index])) {
            $achievement->update($data[$index]);
        }
    }
}

echo "Achievements sample data updated.\n";
