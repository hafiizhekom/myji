<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchasing', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('po_code', 50);
            $table->string('item', 50);
            $table->double('unit');
            $table->integer('unit_price');
            $table->integer('total_price');
            $table->integer('discount_amount');
            $table->integer('discount_percentage');
            $table->integer('shipping_cost');
            $table->integer('total_price_with_shipping');
            $table->string('supplier_name', 100);
            $table->date('order_date');
            $table->date('estimation_date');
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
        Schema::dropIfExists('purchasing');
    }
}
