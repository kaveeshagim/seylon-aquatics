<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TestOrder;
use Carbon\Carbon;

class TestOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run():void
    {
        //
        // Clear the table first
        // TestOrder::truncate();

        // Insert test data
        TestOrder::create([
            'name' => 'Order 9',
            'status' => 'pending',
        ]);

        TestOrder::create([
            'name' => 'Order 10',
            'status' => 'completed',
        ]);

        TestOrder::create([
            'name' => 'Order 11',
            'status' => 'pending',
        ]);
    }
}
