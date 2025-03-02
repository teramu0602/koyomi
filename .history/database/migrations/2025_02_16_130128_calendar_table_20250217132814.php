<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar', function (Blueprint $table) {
        $table->id();
        $table->string('user_id');
        $table->string('title'); // 
        $table->string('description');  // 
        $table->string('date') ;
        $table->string('created_at');
        $table->timestamps();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar_group_table');
        Schema::dropIfExists('calendar_table');
        Schema::dropIfExists('user_group_table');
        Schema::dropIfExists('group_table');
        Schema::dropIfExists('user_table');
    }
};
