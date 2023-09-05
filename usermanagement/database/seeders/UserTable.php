<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name'=>'testAdmin', 'email'=>'admin@test.com', 'password'=>bcrypt(123456) ],
            ['name'=>'testUser1', 'email'=>'user1@test.com', 'password'=>bcrypt(123456) ],
            ['name'=>'testUser2', 'email'=>'user2@test.com', 'password'=>bcrypt(123456) ],
        ];

        foreach($users as $key => $value){
            User::create($value);
        }
    }
}
