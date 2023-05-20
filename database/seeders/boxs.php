<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class boxs extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('boxs')->insert([
            [
                'title' => "aaaaa",
                'description' => "here you can write any description about the box so u can write what ever you want ....",
                'oldprice' => 50,
                'newprice' => 10,
                'quantity' => 10,
                'remaining_quantity' => 10,
                'image' => "OIP-884653967_1683287703.jpg",
                'category' => "MEAT",
                'status' => "ACCEPTED",
                'partner_id' => 1,
                'startdate' => date('2023-03-11 13:22:22'),
                'enddate' => date('2023-03-29 15:22:22'),
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => "aaaaa",
                'description' => "here you can write any description about the box so u can write what ever you want ....",
                'oldprice' => 50,
                'newprice' => 10,
                'quantity' => 10,
                'remaining_quantity' => 10,
                'image' => "foody-545533417_1683287734.jpg",
                'category' => "PASTRY",
                'status' => "PENDING",
                'partner_id' => 1,
                'startdate' => date('2023-03-11 13:22:22'),
                'enddate' => date('2023-03-29 15:22:22'),
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]); 
       }
}
