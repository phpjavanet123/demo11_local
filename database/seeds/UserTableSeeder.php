<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new User();
		$user1->name = 'Admin Name';
		$user1->email = 'admin@example.com';
		$user1->password = bcrypt('secret');
		$user1->role_id = 1;
		$user1->save();
		
		$user2 = new User();
		$user2->name = 'User Name';
		$user2->email = 'user@example.com';
		$user2->password = bcrypt('secret');
		$user2->role_id = 2;
		$user2->save();
    }
}
