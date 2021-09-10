<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('promo_name');
            $table->float('fixed_amount', 8, 2);
            $table->float('percentage_amount', 8, 2);
            $table->timestamp('start_time')->default(\DB::raw('CURRENT_TIMESTAMP'));;
            $table->timestamp('end_time')->default(\DB::raw('CURRENT_TIMESTAMP'));;
            $table->boolean('active');
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
        Schema::drop('promos');
    }
}