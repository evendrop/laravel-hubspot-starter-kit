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
        Schema::create('portals', function (Blueprint $table) {
            
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('team_id');
            $table->string('hub__id')->nullable();
            $table->string('hub__name')->nullable();
            $table->string('hub__user_email')->nullable();
            $table->string('hub__domain')->nullable();
            $table->dateTime('token_expires');
            $table->string('refresh_token');
            $table->string('access_token');
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
        Schema::dropIfExists('portals');
    }
};
