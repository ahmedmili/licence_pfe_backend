<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class like_boxs extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('likes')->insert([
            [
                'user_id' => 2,
                'box_id' => 1,
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                // 'created_at' => date('d-m-Y H:i:s'),
                // 'updated_at' => date('d-m-Y H:i:s'),
            ],
       
            [
                'user_id' => 2,
                'box_id' => 2,
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                // 'created_at' => date('d-m-Y H:i:s'),
                // 'updated_at' => date('d-m-Y H:i:s'),
            ],
       
            [
                'user_id' => 2,
                'box_id' => 3,
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                // 'created_at' => date('d-m-Y H:i:s'),
                // 'updated_at' => date('d-m-Y H:i:s'),
            ],
       
            [
                'user_id' => 2,
                'box_id' => 4,
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                // 'created_at' => date('d-m-Y H:i:s'),
                // 'updated_at' => date('d-m-Y H:i:s'),
            ],
       
        ]);    
     }
}
