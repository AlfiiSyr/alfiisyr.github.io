<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::insert([
        [
        'firstname'=>'alfi',
        'lastname'=>'syahrin',
        'username'=>'alfi_syr',
        'email'=>'alfii.syr@gmail.com',
        'phone'=>'082275631199',
        'dateofbirth'=>'1998-09-23',
        'password'=>Hash::make('alfi'),
      ],
      [
        'firstname'=>'alfi',
        'lastname'=>'syahrin',
        'username'=>'alfi_syr1',
        'email'=>'alfii.syr1@gmail.com',
        'phone'=>'0822756311991',
        'dateofbirth'=>'1998-09-23',
        'password'=>Hash::make('alfi'),
      ]
      ]);
    }
}
