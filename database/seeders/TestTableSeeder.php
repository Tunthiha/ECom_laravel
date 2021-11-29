<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $prdoucts = ['P1', 'P2', 'P3','P4','p5','p6','p7'];

        // foreach($prdoucts as $product){
        //     Product::create([
        //         'name'=>$product,
        //         'description'=>'Nothing',
        //         'price'=>'1200',
        //         'total_quantity'=>'55',
        //         'category_id'=> rand(1,5),
        //         'user_id'=>1
        //     ]);
        // }

        User::create([
            'name'=>'admin',
            'email'=>'admin@a.com',
            'password' => Hash::make('password'),
            'role' => "admin"
        ]);


    }
}
