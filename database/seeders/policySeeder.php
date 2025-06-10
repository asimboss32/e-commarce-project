<?php

namespace Database\Seeders;

use App\Models\policy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class policySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $policy = [
            [
                'privacy_policy' => 'my name is nuralom',
                'terms_conditions' => 'my name is nuralom',
                'refund_policy' => 'my name is nuralom',
                'payment_policy' => 'my name is nuralom',
                'about_us' => 'my name is nuralom',
                'return_process' => 'my name is nuralom',
            ]
        ];
        policy::insert($policy);
    }
}
