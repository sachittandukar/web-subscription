<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribersWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriber_website', function (Blueprint $table) {
            $table->foreignId('subscriber_id')->constrained();
            $table->foreignId('website_id')->constrained();
            $table->foreign('subscriber_id', 'fk_subscriber_id')->references('id')->on('subscribers')->onDelete('cascade');
            $table->foreign('website_id', 'fk_website_id')->references('id')->on('websites')->onDelete('cascade');
            $table->primary(['subscriber_id', 'website_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribers_websites');
    }
}
