<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_groups', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->bigInteger('user_id')->unsigned();
            $table->string('payment_ref')->nullable();
            $table->double('total_amount', 10, 4);
            $table->integer('item_number');
            $table->string('payment_method');
            $table->string('customer_phone')->nullable();
            $table->string('service_name');
            $table->text('client_request')->nullable();
            $table->text('client_response')->nullable();
            $table->text('client_vend_request')->nullable();
            $table->text('client_vend_response')->nullable();
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
        Schema::dropIfExists('transaction_groups');
    }
}
