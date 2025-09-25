<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expense;

class ExpenseSeeder extends Seeder
{
    public function run()
    {
        Expense::create(['description' => 'Room Cleaning Supplies', 'amount' => 150000]);
        Expense::create(['description' => 'Electricity Bill', 'amount' => 2000000]);
    }
}
