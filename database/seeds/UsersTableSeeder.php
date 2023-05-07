<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::truncate();

        $adminRole = Role::create('name','admin');
        $authorRole = Role::create('name','author');
        $orderRole = Role::create('name','order');
        $userRole = Role::create('name','user');

       
        $admin =User::create([
            'name'=>'Nguyễn Minh Đức',
            'email'=>'duc2982000@gmail.com',
            'password'=>md5('112213362'),
        ]);
        $author =User::create([
            'name'=>'Nguyễn Minh Tien',
            'email'=>'duc2982000@gmail.com',
            'password'=>md5('112213362'),
        ]);
        $order =User::create([
            'name'=>'Vuong Sy Tung',
            'email'=>'duc2982000@gmail.com',
            'password'=>md5('112213362'),
        ]);
        $user =User::create([
            'name'=>'Nguyễn Minh Đức',
            'email'=>'duc2982000@gmail.com',
            'password'=>md5('112213362'),
        ]);

        $admin ->role->attach($adminRole);
        $author ->role->attach($authorRole);
        $order ->role->attach($orderRole);
        $user ->role->attach($userRole);

    }
}
