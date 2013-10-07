<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        //DB::table('users')->delete();
		DB::statement('ALTER TABLE permissions AUTO_INCREMENT = 1');

        $users = array(
            array(
                'username'      => 'admin',
                'email'      => 'admin@example.org',
                'password'   => Hash::make('admin'),
                'confirmed'   => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'username'      => 'broker',
                'email'      => 'broker@example.org',
                'password'   => Hash::make('broker'),
                'confirmed'   => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'username'      => 'campus',
                'email'      => 'campus@example.org',
                'password'   => Hash::make('campus'),
                'confirmed'   => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
           ),
           array(
                'username'      => 'community',
                'email'      => 'community@example.org',
                'password'   => Hash::make('community'),
                'confirmed'   => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
           )
        );

        DB::table('users')->insert( $users );
    }

}
