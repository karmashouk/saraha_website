<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Massage;

class MassageSeeder extends Seeder
{
    public function run(): void
    {
        Massage::create([
            'from_user_id' => 1,  // Abdo
            'to_user_id' => 2,    // Sabry
            'content' => 'Hi Sabry',
        ]);

        Massage::create([
            'from_user_id' => null,  // مجهول
            'to_user_id' => 1,       // Abdo
            'content' => 'Hi Abdo',
        ]);
    }
}
