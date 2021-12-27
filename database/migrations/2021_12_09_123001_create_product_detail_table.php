<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_detail', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('product_id');
            $table->integer('size_id');
            $table->integer('price')->default(0);
            $table->double('yard_per_piece')->default(0);
            $table->string('shopee_link', 100);
            $table->string('whatsapp_link', 100);
            $table->string('image_file', 100)->default('');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
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
        Schema::dropIfExists('product_detail');
    }
}
