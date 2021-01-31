<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBraceletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bracelets', function (Blueprint $table) {
            $table->id();
            $table->string('name',40) -> unique();
            $table->integer('on_stock_quantity');
            $table->double('cost',10,2);
            $table->double('lower_cost',10,2)-> nullable();
            $table->integer('sold_quantity') -> $this->default(0);
            $table->string('image') -> nullable();
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
        Schema::dropIfExists('bracelets');
    }
}
