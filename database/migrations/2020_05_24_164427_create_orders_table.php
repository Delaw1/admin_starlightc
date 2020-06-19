<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('section_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('description');
            $table->bigInteger('words')->nullable();
            $table->float('price');
            $table->string('timeframe');
            $table->dateTime('endtime', 0);
            $table->boolean('timeup')->default(0);
            $table->boolean('paid')->default(1);
            $table->boolean('completed')->default(0);
            $table->foreignId('writer_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->boolean('writer_completed')->default(0);
            $table->string('filepath')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
