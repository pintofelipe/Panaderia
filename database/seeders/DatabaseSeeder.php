<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::factory(100)->create();
        //Provider::factory(5)->create();
        Product::factory(100)->create();
        Order::factory(500)
            ->has(OrderDetail::factory()->count(1))
            ->create();
        //OrderDetail::factory(7)->create();
    }
}
