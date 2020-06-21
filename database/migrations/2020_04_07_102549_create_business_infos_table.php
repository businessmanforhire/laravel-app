<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('business_name');
            $table->string('description')->nullable();
            $table->string('image');
            $table->string('nuis')->nullable();
            $table->string('address')->nullable();
            $table->string('url')->nullable();
            $table->integer('city_id');
            $table->integer('user_create_id');
            $table->integer('user_update_id');
            $table->softDeletes();
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
        Schema::dropIfExists('business_infos');
    }
}
