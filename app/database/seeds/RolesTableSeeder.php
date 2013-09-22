<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        $adminRole = new Role;
        $adminRole->name = 'admin';
        $adminRole->save();
        $user = User::where('username','=','admin')->first();
        $user->attachRole($adminRole);
        
        $BrokerRole = new Role;
        $BrokerRole->name = 'broker';
        $BrokerRole->save();
        $user = User::where('username','=','user')->first();
        $user->attachRole($BrokerRole);
        
        $campusRole = new Role;
        $campusRole->name = 'campus';
        $campusRole->save();
        $user = User::where('username','=','user')->first();
        $user->attachRole($campusRole);
        
        $communityRole = new Role;
        $communityRole->name = 'community';
        $communityRole->save();
        $user = User::where('username','=','user')->first();
        $user->attachRole($communityRole);
    }

}
