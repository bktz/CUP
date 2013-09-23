<?php

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        //DB::table('permissions')->delete();
		DB::statement('ALTER TABLE permissions AUTO_INCREMENT = 1');

        $permissions = array(
            array(
                'name'      => 'create_project',
                'display_name'      => 'Create a project application'
            ),                
            array(
                'name'      => 'apply_to_project',
                'display_name'      => 'Apply to take on a project'
            ),
            array(
                'name'      => 'manage_projects',
                'display_name'      => 'Manage projects'
            ),
            array(
                 'name'      => 'applications',
                'display_name'      => 'View and give feedback on applications'
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
                'name'      => 'manage_brokers',
                'display_name'      => 'Manage brokers'
            ),
            array(
                'name'      => 'manage_tags',
                'display_name'      => 'Manage tags'
            ),
        );

        DB::table('permissions')->insert( $permissions );

        DB::table('permission_role')->delete();

        $permissions = array(
            array(//admin has all the permissions!
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
            array(
                'role_id'      => 1,
                'permission_id' => 6
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 7
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 8
            ),                
            array(//broker has them all too, but can't manage other brokers
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
            array(
                'role_id'      => 2,
                'permission_id' => 6
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 8
            ),
            array(//campus accounts have limited permissions
                'role_id'      => 3,
                'permission_id' => 1
            ),
            array(
                'role_id'      => 3,
                'permission_id' => 2
            ),
            array(//community accounts have limited permissions
                'role_id'      => 4,
                'permission_id' => 1
            ),                
        );

        DB::table('permission_role')->insert( $permissions );
    }

}
