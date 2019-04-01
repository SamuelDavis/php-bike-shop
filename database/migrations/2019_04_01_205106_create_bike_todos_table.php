<?php

use App\Models\Bike;
use App\Models\BikeTodo;
use App\Models\Person;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBikeTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(BikeTodo::TABLE, function (Blueprint $table) {
            $table->bigIncrements(BikeTodo::ATTR_ID);
            $table->timestamp(BikeTodo::CREATED_AT)->nullable();
            $table->timestamp(BikeTodo::UPDATED_AT)->nullable();
            $table->string(BikeTodo::ATTR_DESCRIPTION);
            $table->dateTime(BikeTodo::ATTR_COMPLETED_AT)->nullable();
        });

        Schema::table(BikeTodo::TABLE, function (Blueprint $table) {
            $table->unsignedBigInteger(BikeTodo::ATTR_BIKE_ID)->nullable();
            $table
                ->foreign(BikeTodo::ATTR_BIKE_ID)
                ->references(Bike::ATTR_ID)
                ->on(Bike::TABLE)
                ->onDelete("cascade");
            $table->index(BikeTodo::ATTR_BIKE_ID);
        });

        Schema::table(BikeTodo::TABLE, function (Blueprint $table) {
            $table->unsignedBigInteger(BikeTodo::ATTR_COMPLETED_BY_ID)->nullable();
            $table
                ->foreign(BikeTodo::ATTR_COMPLETED_BY_ID)
                ->references(Person::ATTR_ID)
                ->on(Person::TABLE)
                ->onDelete("cascade");
            $table->index(BikeTodo::ATTR_COMPLETED_BY_ID);
        });

        Schema::table(BikeTodo::TABLE, function (Blueprint $table) {
            $table->unsignedBigInteger(BikeTodo::ATTR_CONFIRMED_BY_ID)->nullable();
            $table
                ->foreign(BikeTodo::ATTR_CONFIRMED_BY_ID)
                ->references(Person::ATTR_ID)
                ->on(Person::TABLE)
                ->onDelete("cascade");
            $table->index(BikeTodo::ATTR_CONFIRMED_BY_ID);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(BikeTodo::TABLE);
    }
}
