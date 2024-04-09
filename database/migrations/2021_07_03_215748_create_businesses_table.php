<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->double("commission_rate")->default(0.7);
            $table->enum('frequency', ['daily', 'weekly', 'monthly'])->default('daily')->nullable();
            $table->string("business_name");
            $table->string("cac_number")->nullable()->default('N/A');
            $table->string("reg_date")->nullable()->default('N/A');
            $table->string("reg_number")->nullable()->default('N/A');
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
        Schema::dropIfExists('businesses');
    }
}
