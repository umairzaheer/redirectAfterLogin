<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rule_id');
            // $table->unsignedBigInteger('login_id')->nullable();
            // $table->unsignedBigInteger('logout_id')->nullable();
            // $table->unsignedBigInteger('registration_id')->nullable();
            // $table->unsignedBigInteger('product_id')->nullable();
            $table->string('customer_tag');

            $table->foreign('rule_id')
            ->references('id')->on('rules')->onDelete('cascade');

            // $table->foreign('login_id')
            //     ->references('id')->on('logins')->onDelete('cascade');

            //     $table->foreign('logout_id')
            //     ->references('id')->on('logouts')->onDelete('cascade');

            //     $table->foreign('registration_id')
            //     ->references('id')->on('registrations')->onDelete('cascade');
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
        Schema::dropIfExists('customer_tags');
    }
}
