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
            $table->text('comment')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedDecimal('discount', 6, 2)->default(0);
            $table->unsignedInteger('vat')->default(0);
            $table->unsignedDecimal('delivery_cost', 6, 2)->default(0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('session_id', 128)->index();
            $table->unsignedDecimal('total', 6, 2)->default(0);

            
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
