<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCafeCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cafe_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cafepost_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();
            
            // 外部キー制約
            $table->foreign('cafepost_id')->references('id')->on('cafeposts')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            
            // cafepost_idとcategory_idの組み合わせの重複を許さない
            $table->unique(['cafepost_id', 'category_id']);
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cafe_category');
    }
}
