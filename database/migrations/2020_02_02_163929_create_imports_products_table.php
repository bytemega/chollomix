<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imports_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('import_id');
            $table->unsignedBigInteger('category_id');
            $table->string('sku')->unique();
            $table->longText('link');
            $table->string('hash');
            $table->boolean('active')->default(1);
            $table->boolean('deleted')->default(0);
            $table->timestamps();
            
            $table->foreign('import_id')->references('id')->on('imports');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imports_products', function (Blueprint $table) {
            //
        });
    }
}
