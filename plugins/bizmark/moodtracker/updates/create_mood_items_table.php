<?php namespace Bizmark\Moodtracker\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateMoodItemsTable Migration
 */
class CreateMoodItemsTable extends Migration
{
    public function up()
    {
        Schema::create('bizmark_moodtracker_mood_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person');
            $table->tinyInteger('mood');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bizmark_moodtracker_mood_items');
    }
}
