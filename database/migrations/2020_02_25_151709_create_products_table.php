<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary');
            $table->longtext('description')->nullable();
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->unsignedBigInteger('sub_cat_id')->nullable();
            $table->float('price');
            $table->float('discount')->default(0);
            $table->float('act_price');
            $table->string('image')->nullable();
            $table->string('brand')->nullable();
            $table->string('keywords')->nullable();
            $table->tinyInteger('is_featured')->default(0);
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->unsignedBigInteger('added_by')->nullable();
            $table->timestamps();
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreign('sub_cat_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('SET NULL');




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
