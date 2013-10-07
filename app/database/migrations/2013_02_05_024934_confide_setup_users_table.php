<?php
use Illuminate\Database\Migrations\Migration;

class ConfideSetupUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates the users table
        Schema::create('users', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('confirmation_code');
            $table->boolean('confirmed')->default(false);
			$table->string('first_name');
			$table->string('last_name');
			$table->string('organization');
			$table->string('phone_number');
			$table->string('phone_number_ext');
			$table->string('address');
			$table->string('city');
			$table->string('postal_code');
			$table->enum('province', array('ON', 'AB', 'BC', 'NB', 'NL', 'NS', 'NU', 'PE', 'QC', 'SK', 'YT', 'MB', 'NT'));
            $table->timestamps();
        });


        // Creates password reminders table
        Schema::create('password_reminders', function($table)
        {
            $table->engine = 'InnoDB';
            $table->string('email');
            $table->string('token');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('password_reminders');
        Schema::drop('users');
    }

}
