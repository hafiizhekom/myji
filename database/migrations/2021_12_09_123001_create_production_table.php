<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('purchasing_id');
            $table->integer('product_detail_id');
            $table->integer('request')->nullable();
            $table->integer('actual')->nullable();
            $table->integer('defect')->nullable();
            $table->date('request_date')->nullable();
            $table->date('actual_date')->nullable();
            $table->date('defect_date')->nullable();
            $table->boolean('actual_complete')->default(false);
            $table->text('reason_defect')->nullable();
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
        Schema::dropIfExists('production');
    }
}
