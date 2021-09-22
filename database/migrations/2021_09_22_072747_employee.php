<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Employee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function(Blueprint $table){
            $table->uuid("employee_id");
            $table->string("user_roles_id");
            $table->string("employee_firstname");
            $table->string("employee_middlename");
            $table->string("employee_lastname");
            $table->string("employee_username");
            $table->string("employee_password");
            $table->string("employee_email");
            $table->integer("employee_status");
            $table->text("employee_image");
            $table->string("created_by");
            $table->string("update_by");
            $table->timestamps();
            $table->softDeletes();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
}
