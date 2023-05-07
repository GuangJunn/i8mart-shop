<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateProductsTable extends Migration
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
            $table->string('name',200);
            $table->string('slug',200);
            $table->text('desc');
            $table->text('content');
            $table->integer('price',255);
            $table->string('image',255)->nullable();
            $table->unsignedBigInteger('cat_product_id');
            $table->foreign('cat_product_id')->references('id')->on('cat_products')->onDelete('cascade');
            $table->integer('status')->nullable();
            $table->integer('status_product')->Nullable;         
            $table->timestamps();
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
        Schema::dropIfExists('products');
    }
}
