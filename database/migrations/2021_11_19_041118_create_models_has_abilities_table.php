<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateModelsHasAbilitiesTable
 */
class CreateModelsHasAbilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('models_has_abilities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ability_id')->unsigned();
            $table->nullableMorphs('model');
            $table->timestamps();

            $table->foreign('ability_id')
                ->references('id')
                ->on('abilities')
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
        Schema::dropIfExists('models_has_abilities');
    }
}
