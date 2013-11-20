<?php

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        //DB::table('permissions')->delete();
		DB::statement('ALTER TABLE permissions AUTO_INCREMENT = 1');

        $permissions = array(
            array(
                'name'      => 'manage_projects',
                'display_name'      => 'Manage  projects'
            ),                             
            array(
                'name'      => 'manage_users',
                'display_name'      => 'Manage users'
            ),
            array(
                'name'      => 'manage_roles',
                'display_name'      => 'Manage roles'
            ),
            array(
                    'name'      => 'manage_tags',
                    'display_name'      => 'Manage tags'
            ),
            array(
                'name'      => 'admin_panel',
                'display_name'      => 'Access the admin panel'
            ),
        );

        DB::table('permissions')->insert( $permissions );

        DB::table('permission_role')->delete();

        /*assign the permission to the roles*/
        $permissions = array(
            array(//admin (role_id 1) has all the permissions!
                'role_id'      => 1,
                'permission_id' => 1
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 2
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 3
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 4
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 5
            ),
            array(//broker (role_id 2) has them all too, for now
                'role_id'      => 2,
                'permission_id' => 1
            ),
            array(
                'role_id'      => 2,
                'permission_id' => 2
            ),
            array(
                'role_id'      => 2,
                'permission_id' => 3
            ),
            array(
                'role_id'      => 2,
                'permission_id' => 4
            ),
            array(
                'role_id'      => 2,
                'permission_id' => 5
            ),             
        );

        DB::table('permission_role')->insert( $permissions );
    }

}
