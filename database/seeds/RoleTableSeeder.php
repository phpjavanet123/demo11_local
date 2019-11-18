<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = new Role();
		$role1->name = 'Administrator';
		$role1->save();
		
		$role2 = new Role();
		$role2->name = 'User';
		$role2->save();
    }
}
