<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('article_partner', function (Blueprint $table) {
            $table->timestamps();
        });
//        Schema::create('article_partners', function (Blueprint $table) {
//            $table->id();
//            $table->foreignId('article_id')->constrained();
//            $table->foreignId('partner_id')->constrained();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_partners');
    }
}
