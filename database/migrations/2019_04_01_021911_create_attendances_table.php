<?php

use App\Models\Attendance;
use App\Models\Event;
use App\Models\Person;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Attendance::TABLE, function (Blueprint $table) {
            $table->bigIncrements(Attendance::ATTR_ID);
            $table->timestamp(Attendance::CREATED_AT)->nullable();
            $table->timestamp(Attendance::UPDATED_AT)->nullable();
            $table->dateTime(Attendance::ATTR_SIGNED_IN_AT);
            $table->dateTime(Attendance::ATTR_SIGNED_OUT_AT)->nullable();
        });

        Schema::table(Attendance::TABLE, function (Blueprint $table) {
            $table->string(Attendance::ATTR_EVENT_ID);
            $table
                ->foreign(Attendance::ATTR_EVENT_ID)
                ->references(Event::ATTR_ID)
                ->on(Event::TABLE)
                ->onDelete("cascade");
            $table->index(Attendance::ATTR_EVENT_ID);
        });

        Schema::table(Attendance::TABLE, function (Blueprint $table) {
            $table->unsignedBigInteger(Attendance::ATTR_PERSON_ID);
            $table
                ->foreign(Attendance::ATTR_PERSON_ID)
                ->references(Person::ATTR_ID)
                ->on(Person::TABLE)
                ->onDelete("cascade");
            $table->index(Attendance::ATTR_PERSON_ID);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Attendance::TABLE);
    }
}
