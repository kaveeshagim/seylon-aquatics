<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Metric;

class MetricsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Metric::create(['name' => 'Visitors', 'value' => 160]);
        Metric::create(['name' => 'Sales', 'value' => 80]);
        Metric::create(['name' => 'Sign-ups', 'value' => 20]);
        Metric::create(['name' => 'Active Users', 'value' => 50]);
        Metric::create(['name' => 'Test Users', 'value' => 50]);
    }
}
