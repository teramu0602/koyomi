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
        // ユーザーテーブル
        Schema::create('user_table', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->timestamps();
        });

        // グループテーブル
        Schema::create('group_table', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('owner_id')->constrained('user_table')->onDelete('cascade');
            $table->timestamps();
        });

        // ユーザーとグループの中間テーブル
        Schema::create('user_group_table', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user_table')->onDelete('cascade');
            $table->foreignId('group_id')->constrained('group_table')->onDelete('cascade');
            $table->enum('role', ['member', 'admin'])->default('member');
            $table->timestamps();
        });

        // カレンダーテーブル
        Schema::create('calendar_table', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user_table')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('date');
            $table->enum('visibility', ['private', 'group', 'public'])->default('private');
            $table->timestamps();
        });

        // カレンダーとグループの関連テーブル
        Schema::create('calendar_group_table', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calendar_id')->constrained('calendar_table')->onDelete('cascade');
            $table->foreignId('group_id')->constrained('group_table')->onDelete('cascade');
            $table->timestamps();
        });
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
