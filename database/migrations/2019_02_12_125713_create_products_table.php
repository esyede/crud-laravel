<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->integer('catalog_id')->index();
            
            $table->string('link');
            $table->string('name');
            $table->integer('price');
            $table->text('image');
            $table->string('custom_image')->nullable();
            $table->integer('stock')->default(10);
            $table->integer('weight')->nullable();
            $table->enum('condition', ['new', 'used'])->default('new');
            $table->string('variant')->nullable();
            $table->string('mp_name')->nullable();
            $table->string('mp_categories')->nullable();
            $table->text('description')->nullable();
            $table->enum('assurance', ['yes', 'no'])->default('no');
            $table->string('courier')->nullable();
            $table->string('supplier')->nullable();
            $table->enum('status', ['exists', 'deleted'])->default('exists');
            $table->integer('margin')->default(100);
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
}
