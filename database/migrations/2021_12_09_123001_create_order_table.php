<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('channel_id');
            $table->integer('customer_id');
            $table->integer('discount_amount')->default(0);
            $table->string('address_shipping', 200);
            $table->integer('total_price')->default(0);
            $table->date('order_date');
            $table->enum('type_order', ['standart', 'return'])->default('standart');
            $table->integer('return_order');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
