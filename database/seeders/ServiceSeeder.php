<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Consultation',
                'price' => 150,
                'description' => 'Professional consultation service',
                'is_available' => true,
            ],
            [
                'name' => 'Repair',
                'price' => 200,
                'description' => 'Comprehensive repair service',
                'is_available' => true,
            ],
            [
                'name' => 'Coaching Session',
                'price' => 250,
                'description' => 'In-depth coaching session',
                'is_available' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

    }
}
