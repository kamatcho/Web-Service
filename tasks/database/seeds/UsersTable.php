<?php

use Illuminate\Database\Seeder;

class UsersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new  \App\User();
        $user->name = 'Kamatcho';
        $user->email = 'mohamed.phpstorm@gmail.com';
        $user->password = bcrypt(123);
        $user->api_token = str_random();
        $user->save();
    }
}
