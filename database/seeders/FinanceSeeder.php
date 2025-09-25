<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Finance;

class FinanceSeeder extends Seeder
{public function run()
{
    // 10 data reservation
    Finance::create(['reservation_id' => 1, 'expense_id' => null]);
    Finance::create(['reservation_id' => 2, 'expense_id' => null]);
    Finance::create(['reservation_id' => 3, 'expense_id' => null]);
    Finance::create(['reservation_id' => 4, 'expense_id' => null]);
    Finance::create(['reservation_id' => 5, 'expense_id' => null]);
    Finance::create(['reservation_id' => 6, 'expense_id' => null]);
    Finance::create(['reservation_id' => 7, 'expense_id' => null]);
    Finance::create(['reservation_id' => 8, 'expense_id' => null]);
    Finance::create(['reservation_id' => 9, 'expense_id' => null]);
    Finance::create(['reservation_id' => 10, 'expense_id' => null]);

    // 10 data expense
    Finance::create(['reservation_id' => null, 'expense_id' => 1]);
    Finance::create(['reservation_id' => null, 'expense_id' => 2]);
    Finance::create(['reservation_id' => null, 'expense_id' => 3]);
    Finance::create(['reservation_id' => null, 'expense_id' => 4]);
    Finance::create(['reservation_id' => null, 'expense_id' => 5]);
    Finance::create(['reservation_id' => null, 'expense_id' => 6]);
    Finance::create(['reservation_id' => null, 'expense_id' => 7]);
    Finance::create(['reservation_id' => null, 'expense_id' => 8]);
    Finance::create(['reservation_id' => null, 'expense_id' => 9]);
    Finance::create(['reservation_id' => null, 'expense_id' => 10]);
}

}
