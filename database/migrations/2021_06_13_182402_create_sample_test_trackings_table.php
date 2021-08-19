<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleTestTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_test_trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sample_tracking_id')->constrained('sample_trackings')->onDelete('cascade');
            $table->foreignId('questionnaire_id')->constrained('questionnaires')->onDelete('cascade');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->index('sample_tracking_id');
            $table->index('questionnaire_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sample_test_trackings');
    }
}
