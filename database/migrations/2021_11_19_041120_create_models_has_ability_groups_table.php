<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateModelsHasAbilityGroupsTable
 */
class CreateModelsHasAbilityGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('models_has_ability_groups', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ability_group_id')->unsigned();
            $table->nullableMorphs('model');
            $table->timestamps();

            $table->foreign('ability_group_id')
                ->references('id')
                ->on('ability_groups')
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
        Schema::dropIfExists('models_has_ability_groups');
    }
}
