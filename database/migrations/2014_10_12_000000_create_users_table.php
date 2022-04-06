<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mother_name')->nullable();
            $table->string('type')->nullable();
            $table->string('dni')->nullable();
            $table->integer('verification_method`')->nullable();
            $table->decimal('latitude', 10, 10)->nullable();
            $table->decimal('longitude', 10, 10)->nullable();
            $table->string('address')->nullable();
            $table->decimal('residence_latitude', 10, 10)->nullable();
            $table->decimal('residence_longitude', 10, 10)->nullable();
            $table->string('residence_address')->nullable();
            $table->dateTime('verifiation_time')->nullable();
            $table->string('unique_key')->nullable();
            $table->string('commune_visit')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('origin_country')->nullable();
            $table->string('key')->nullable();
            $table->string('city')->nullable();
            $table->string('pin')->nullable();
            $table->string('last_location')->nullable();
            $table->string('current_location')->nullable();
            $table->longText('last_pcr_result')->nullable();
            $table->string('quarantine_status')->nullable();
            $table->integer('violation_count')->default(0);
            $table->dateTime('completion_date')->nullable();
            $table->dateTime('last_seen')->nullable();
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
