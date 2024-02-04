<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('copons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code')->nullable();
            $table->string('coupon_date')->nullable();
            $table->string('coupon_type')->nullable();
            $table->integer('coupon_amount')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('copons');
    }
};
