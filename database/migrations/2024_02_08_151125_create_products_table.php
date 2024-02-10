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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('childcategory_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('pickup_point_id')->nullable();
            $table->string('product_name');
            $table->string('product_code');
            $table->string('product_unit')->nullable();
            $table->string('product_tags')->nullable();
            $table->string('product_video')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('stock_quantity')->nullable();
            $table->string('warehouse')->nullable();
            $table->string('product_description')->nullable();
            $table->string('product_thumbnail')->nullable();
            $table->string('product_images')->nullable();
            $table->string('product_featured')->nullable();
            $table->string('today_deal')->nullable();
            $table->string('product_status')->nullable();
            $table->string('cash_on_delivery')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('admin_id')->nullable();
            $table->string('flash_deal_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');

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
        Schema::dropIfExists('products');
    }
};
