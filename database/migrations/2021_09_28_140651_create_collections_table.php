<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("transaction_id")->nullable();
            $table->string("transaction_reference")->nullable();
            
            $table->string("link_reference")->nullable();
            $table->string("email")->nullable();
            $table->string("phone_number")->nullable();

            $table->string("ussd_code")->nullable();
            $table->string("bank_name")->nullable();
            $table->string("account_number")->nullable();
            $table->string("account_name")->nullable();
            $table->string("payment_method")->nullable();
            $table->string("collection_method");
            $table->string("payment_reference")->nullable();

            $table->double("amount")->nullable();
            $table->double("payout_amount")->default(0.0);
            $table->text("description")->nullable();
            $table->timestamp("verified_at")->nullable();
            $table->boolean("settled")->default(false);
            $table->bigInteger("settlement_id")->nullable();
            $table->string("date");
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
        Schema::dropIfExists('collections');
    }
}
