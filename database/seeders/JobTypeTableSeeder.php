<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $system_data=
        [
            ['id'=>1,'title' => 'admin', 'created_by' => 1,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id'=>2,'title' => 'orignal_store_worker', 'created_by' => 1,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id'=>3,'title' => 'transporter', 'created_by' => 1,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id'=>4,'title' => 'conquest_factor', 'created_by' => 1,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id'=>5,'title' => 'sort_worker', 'created_by' => 1,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id'=>6,'title' => 'cream_sorting_worker', 'created_by' => 1,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id'=>7,'title' => 'extra_sorting_worker', 'created_by' => 1,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id'=>8,'title' => 'compression_worker', 'created_by' => 1,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];
        foreach ($system_data as $item) {
            Job::updateOrCreate(['id' => $item['id']],$item);
        }
    }
}
