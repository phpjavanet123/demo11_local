<?php

use Illuminate\Database\Seeder;
use App\Client;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client1 = new Client();
		$client1->name = 'Test1';
		$client1->email = 'test1@mail.com';
		$client1->password = bcrypt('secret');
		$client1->save();
		
		$client2 = new Client();
		$client2->name = 'Test2';
		$client2->email = 'test2@mail.com';
		$client2->password = bcrypt('secret');
		$client2->save();
    }
}
