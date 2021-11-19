<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateDevicesTable
 */
class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('token_id')->unsigned();
            $table->morphs('model');
            $table->string('user_agent')->nullable();
            $table->string('ip_address');
            $table->timestamp('last_at');
            $table->timestamps();

            $table->foreign('token_id')
                ->references('id')
                ->on('personal_access_tokens')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
