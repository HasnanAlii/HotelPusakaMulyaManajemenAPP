<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $baseDate = Carbon::now()->subMonths(3);

        // Buat 10 data dummy
        for ($i = 1; $i <= 10; $i++) {
            $checkIn = $baseDate->copy()->addDays(rand(0, 5));
            $checkOut = $checkIn->copy()->addDays(rand(1, 5));

            Reservation::create([
                'customer_id' => rand(1, 5), // random customer id
                'room_id'     => rand(1, 5), // random room id
                'check_in'    => $checkIn->toDateString(),
                'check_out'   => $checkOut->toDateString(),
            ]);
        }
    }
}
