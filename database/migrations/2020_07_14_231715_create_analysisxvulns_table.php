<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalysisXvulnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analysisxvulns', function (Blueprint $table) {
            $table->id();
            $table->string('vulName');
            $table->longText('vulDescription');
            $table->longText('vulRecomendation');
            $table->longText('vulReference');
            $table->string('vulRisk');
            $table->longText('target')->nullable;
            $table->longText('evidences')->nullable;
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
        Schema::dropIfExists('analysisxvulns');
    }
}
