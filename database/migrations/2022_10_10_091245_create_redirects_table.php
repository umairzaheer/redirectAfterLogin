<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedirectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redirects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rule_id');
            $table->BigInteger('product_id')->nullable();
            $table->BigInteger('collection_id')->nullable();
            $table->BigInteger('page_id')->nullable();
            $table->string('last_page')->nullable();
            $table->foreign('rule_id')
            ->references('id')->on('rules')->onDelete('cascade');
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
        Schema::dropIfExists('redirects');
    }
}
