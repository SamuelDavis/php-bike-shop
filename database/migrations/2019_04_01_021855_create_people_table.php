<?php

use App\Models\Person;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Person::TABLE, function (Blueprint $table) {
            $table->bigIncrements(Person::ATTR_ID);
            $table->timestamp(Person::CREATED_AT)->nullable();
            $table->timestamp(Person::UPDATED_AT)->nullable();
            $table->string(Person::ATTR_NAME);
            $table->string(Person::ATTR_EMAIL)->nullable();
            $table->string(Person::ATTR_PHONE)->nullable();
            $table->string(Person::ATTR_ADDRESS)->nullable();
            $table->dateTime(Person::ATTR_DOB)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Person::TABLE);
    }
}
