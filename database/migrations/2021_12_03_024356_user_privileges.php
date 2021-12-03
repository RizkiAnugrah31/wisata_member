<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserPrivileges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_privileges', function(Blueprint $table){
            $table->uuid("user_privileges_id")->primary();
            $table->uuid("user_role_id")->index();
            $table->uuid("menu_id")->index();
            $table->string("view");
            $table->string("add");
            $table->string("edit"); 
            $table->string("delete");
            $table->string("other");
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
        //
    }
}
