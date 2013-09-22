<?php

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('permissions')->delete();


        $permissions = array(
            array(
                'name'      => 'create_project',
                'display_name'      => 'create a project application'
            ),                
            array(
                'name'      => 'apply_to_project',
                'display_name'      => 'apply to take on a project'
            ),
            array(
                'name'      => 'manage_projects',
                'display_name'      => 'manage projects'
            ),
            array(
                 'name'      => 'applications',
                'display_name'      => 'view and give feedback on applications'
            ),                
            array(
                'name'      => 'manage_users',
                'display_name'      => 'manage users'
            ),
            array(
                'name'      => 'manage_roles',
                'display_name'      => 'manage roles'
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
            array(//broker has them all too, but implicity can't manage other brokers
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
