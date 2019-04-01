<?php

use App\Models\Bike;
use App\Models\Person;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Bike::TABLE, function (Blueprint $table) {
            $table->bigIncrements(Bike::ATTR_ID);
            $table->timestamp(Bike::CREATED_AT)->nullable();
            $table->timestamp(Bike::UPDATED_AT)->nullable();
            $table->string(Bike::ATTR_DESCRIPTION);
            $table->unsignedDecimal(Bike::ATTR_VALUE)->nullable();
            $table->text(Bike::ATTR_NOTES)->nullable();
        });

        Schema::table(Bike::TABLE, function (Blueprint $table) {
            $table->unsignedBigInteger(Bike::ATTR_SOURCE_ID);
            $table
                ->foreign(Bike::ATTR_SOURCE_ID)
                ->references(Person::ATTR_ID)
                ->on(Person::TABLE);
            $table->index(Bike::ATTR_SOURCE_ID);
        });

        Schema::table(Bike::TABLE, function (Blueprint $table) {
            $table->unsignedBigInteger(Bike::ATTR_OWNER_ID)->nullable();
            $table
                ->foreign(Bike::ATTR_OWNER_ID)
                ->references(Person::ATTR_ID)
                ->on(Person::TABLE);
            $table->index(Bike::ATTR_OWNER_ID);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Bike::TABLE);
    }
}
