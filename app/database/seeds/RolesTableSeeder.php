<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
        //DB::table('roles')->delete();
		DB::statement('ALTER TABLE permissions AUTO_INCREMENT = 1');

        $adminRole = new Role;
        $adminRole->name = 'admin';
        $adminRole->save();
        $user = User::where('username','=','admin')->first();
        $user->attachRole($adminRole);
        
        $BrokerRole = new Role;
        $BrokerRole->name = 'broker';
        $BrokerRole->save();
        $user = User::where('username','=','broker')->first();
        $user->attachRole($BrokerRole);
        
        $campusRole = new Role;
        $campusRole->name = 'campus';
        $campusRole->save();
        $user = User::where('username','=','campus')->first();
        $user->attachRole($campusRole);
        
        $communityRole = new Role;
        $communityRole->name = 'community';
        $communityRole->save();
        $user = User::where('username','=','community')->first();
        $user->attachRole($communityRole);
    }

}
