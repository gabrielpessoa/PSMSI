<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            0 => [
                'name' => 'Gabriel Pessoa',
                'email' => 'gabrielpessoanascimento@gmail.com',
                'password' => '$2y$10$IlnK95ujVV267MXk/Rb6juJBgbVOzTD.dGCulfGCNY05AzC9a.Ixu',
            ],
        ];
        DB::table('users')->insert($user);
    }
}
