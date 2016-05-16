<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserDefaultAccount extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'Account',
            'role_id' => 0,
            'position' => 'Administrator',
            'timezone' => 'Asia/Manila',
            'activated' => 1,
            'email' => 'adm.asdfsadfasd234wfdfgxetdfgd@gmail.com',
            'password' => bcrypt('taskadminmanger2016'),
        ]);
    }
}
