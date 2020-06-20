<?php

use Illuminate\Database\Seeder;

class UserTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=array(
        	array(
        		'name' => 'Admin',
        		'email'=>'sandeep024@gmail.com',
        		'password'=>Hash::make('admin1234') ,
        		'status'=>'active',
        		'role'=>'admin',
    		),
        	array(
        		'name' => 'seller',
        		'email'=>'seller024@gmail.com',
        		'password'=>Hash::make('seller1234') ,
        		'status'=>'active',
        		'role'=>'seller',
    		),
    		array(
        		'name' => 'user',
        		'email'=>'user024@gmail.com',
        		'password'=>Hash::make('user1234') ,
        		'status'=>'active',
        		'role'=>'user',
    		)

    	);
        	DB::table('users')	->insert($users);
    }
}
