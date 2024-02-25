<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContactMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contactTypes = [
            'Email',
            'Phone',
            'In Person',
            'LinkedIn',
            'Twitter',
            'Website',
            'Slack',
            'Discord',
            'Zoom',
            'Other',
        ];

        foreach ($contactTypes as $contactType) {
            \App\Models\ContactMethod::create([
                'name' => $contactType,
            ]);
        }
    }
}
