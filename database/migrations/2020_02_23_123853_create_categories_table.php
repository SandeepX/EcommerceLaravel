<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('title')->unique(); 
            $table->string('slug')->unique(); 
            $table->text('summary')->nullable(); 
            $table->enum('is_parent',[1,0])->default(1);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table ->foreign('parent_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->string ('image',50)->nullable(); 
            $table->unsignedBigInteger('added_by')->nullable(); 
            $table ->foreign('added_by')->references('id')->on('users')->onDelete('SET NULL');
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
        Schema::dropIfExists('categories');
    }
}
