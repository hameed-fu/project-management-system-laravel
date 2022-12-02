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
        Schema::create('hours_spents', function (Blueprint $table) {
            $table->id();
            // hours spent on project
            $table->string('analysis');
            $table->string('designing');
            $table->string('coding');
            $table->string('testing');
            $table->string('project_management');
            $table->integer('project_id');
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
        Schema::dropIfExists('hours_spents');
    }
};
