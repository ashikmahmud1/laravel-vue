<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Plan::create([
            'name' => 'Standard',
            'price' => 1999,
            'stripe_plan_id' =>'price_1J9PEBI8s2DIdPcXs3H5BPPT'
        ]);
        Plan::create([
            'name' => 'Basic',
            'price' => 2999,
            'stripe_plan_id' =>'price_1J9PEBI8s2DIdPcXlH7OfKcy'
        ]);
        Plan::create([
            'name' => 'Premium',
            'price' => 3999,
            'stripe_plan_id' =>'price_1J9PEBI8s2DIdPcXrMGsNJIQ'
        ]);
    }
}
