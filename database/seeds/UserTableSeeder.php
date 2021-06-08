<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $role_user = Role::where('name', 'user')->first();
        $role_admin = Role::where('name', 'admin')->first();


        //Ejemplo de usuario normal
        $user = new User();
        $user->nick = 'User';
        $user->nombre = 'User';
        $user->email = 'user@example.com';
        $user->password = bcrypt('123456');
        $user->imagen='https://images-na.ssl-images-amazon.com/images/I/81SyEbLl0LL._SL1500_.jpg';
        $user->save();
        $user->roles()->attach($role_user);


        //Ejemplo de Admin
        $user = new User();
        $user->nick = 'Admin';
        $user->nombre = 'Admin';
        $user->email = 'admin@example.com';
        $user->password = bcrypt('123456');
        $user->imagen='https://images-na.ssl-images-amazon.com/images/I/81SyEbLl0LL._SL1500_.jpg';

        $user->save();
        $user->roles()->attach($role_admin);



        //Carles
        $user = new User();
        $user->nick = 'Carles';
        $user->nombre = 'Carles';
        $user->email = 'carles@pcadicto.com';
        $user->password = bcrypt('123456');
        $user->imagen='https://images-na.ssl-images-amazon.com/images/I/81SyEbLl0LL._SL1500_.jpg';

        $user->save();
        $user->roles()->attach($role_admin);



        //Dani
        $user = new User();
        $user->nick = 'Dani';
        $user->nombre = 'Dani';
        $user->email = 'dani@pcadicto.com';
        $user->password = bcrypt('123456');
        $user->imagen='https://images-na.ssl-images-amazon.com/images/I/81SyEbLl0LL._SL1500_.jpg';

        $user->save();
        $user->roles()->attach($role_admin);


    }
}