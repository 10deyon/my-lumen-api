<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirtimeTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airtime_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('group_id');
            $table->string('transaction_id');
            $table->string('phone_number');
            $table->string('provider');
            $table->string('amount');
            $table->enum('status', ['incomplete', 'pending', 'fulfilled', 'failed'])->default('incomplete');
            $table->string('request_time');
            $table->string('response_time')->nullable();
            $table->text('api_vend_request')->nullable();
            $table->text('api_vend_response')->nullable();
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
        Schema::dropIfExists('airtime_transactions');
    }
}
