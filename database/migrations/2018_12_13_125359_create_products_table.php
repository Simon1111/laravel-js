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
            $table->string('name'); 
            $table->unsignedInteger('price'); // - себестоимость товара (от 1 до 1000) 
            $table->unsignedInteger('price_lid'); // - стоимость лида (от 1 до 10000)
            $table->unsignedInteger('cost_email'); // - расходы на почту (от 1 до 1000)
            $table->unsignedInteger('cost_sends'); // - расходы на упаковку и отправку (от 1 до 1000)
            $table->unsignedInteger('approve'); // - необходимый уровень аппрува (от 1 до 100)
            $table->unsignedInteger('buyout'); // - выкуп (от 1 до 100)
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
