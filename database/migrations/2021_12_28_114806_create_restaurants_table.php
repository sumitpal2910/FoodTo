<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('restaurant_owners')->onDelete('cascade');

            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');

            $table->unsignedBigInteger('district_id');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');

            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->string('slug');
            $table->string('phone');
            $table->string('cuisine');

            $table->string('alt_phone')->nullable();
            $table->string('gst_no');
            $table->string('trade_name');
            $table->string('license_no');
            $table->string('fssai_no');

            $table->string('kyc')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('bg_image')->nullable();
            $table->string('fssai_image')->nullable();
            $table->string('license_image')->nullable();
            $table->string('menu')->nullable();

            $table->string('full_address');
            $table->string('area');
            $table->string('landmark');
            $table->string('latitude');
            $table->string('longitude');
            $table->integer('pincode');
            $table->tinyInteger('status')->default(0);

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
        Schema::dropIfExists('restaurants');
    }
}
