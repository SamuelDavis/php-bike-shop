<?php

use App\Models\Event;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Event::TABLE, function (Blueprint $table) {
            $table->string(Event::ATTR_ID)->primary();
            $table->timestamp(Event::CREATED_AT)->nullable();
            $table->timestamp(Event::UPDATED_AT)->nullable();
            $table->string(Event::ATTR_NAME);
            $table->string(Event::ATTR_DESCRIPTION)->nullable();
            $table->string(Event::ATTR_ADDRESS);
            $table->dateTime(Event::ATTR_STARTS_AT);
            $table->dateTime(Event::ATTR_ENDS_AT)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Event::TABLE);
    }
}
