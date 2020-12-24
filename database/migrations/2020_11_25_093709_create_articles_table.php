<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('articles')){
            Schema::table('articles',function (Blueprint $table){
                $table->string('intro');
                $table->timestamps();;
            });
        }else{
            Schema::create('articles', function (Blueprint $table) {
                $table->id('article_id');
                $table-> string('name',255);
                $table-> string('intro');
                $table->text('description');
                $table->mediumText('image')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
