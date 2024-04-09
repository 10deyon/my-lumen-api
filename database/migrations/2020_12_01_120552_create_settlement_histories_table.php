<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlement_histories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->string("transaction_reference")->nullable();;
            $table->double("amount");
            $table->string("status")->default("pending");
            $table->double("commission");
            $table->integer("total_transactions")->nullable();
            $table->string("account_number")->nullable();
            $table->string("account_name")->nullable();
            $table->string("bank_name")->nullable();
            $table->string("sort_code")->nullable();

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
        Schema::dropIfExists('settlement_histories');
    }
}
