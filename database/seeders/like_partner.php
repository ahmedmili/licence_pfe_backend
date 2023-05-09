<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class like_partner extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('like_partners')->insert([
            [
                'user_id' => 2,
                'partner_id' => 1,
                // 'created_at' => date('d-m-Y H:i:s'),
                // 'updated_at' => date('d-m-Y H:i:s'),
            ],
        ]);
    }
}
