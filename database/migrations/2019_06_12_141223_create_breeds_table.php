<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breeds', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('breed_id')->unique();
            $table->string('name');
            $table->string('temperament');
            $table->string('life_span');
            $table->string('alt_names');
            $table->string('wikipedia_url');
            $table->string('origin');
            $table->string('weight_imperial');
            $table->boolean('experimental');
            $table->boolean('hairless');
            $table->boolean('natural');
            $table->boolean('rex');
            $table->boolean('suppressed_tail');
            $table->boolean('short_legs');
            $table->boolean('hypoallergenic');
            $table->unsignedInteger('adaptability');
            $table->unsignedInteger('affection_level');
            $table->string('country_code');
            $table->unsignedInteger('child_friendly');
            $table->unsignedInteger('dog_friendly');
            $table->unsignedInteger('energy_level');
            $table->unsignedInteger('grooming');
            $table->unsignedInteger('health_issues');
            $table->unsignedInteger('intelligence');
            $table->unsignedInteger('shedding_level');
            $table->unsignedInteger('social_needs');
            $table->unsignedInteger('stranger_friendly');
            $table->unsignedInteger('vocalisation');

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
        Schema::dropIfExists('breeds');
    }
}
