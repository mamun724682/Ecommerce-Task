<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->decimal('subtotal', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->decimal('discountPercentage', 5, 2);
            $table->decimal('shippingCharges', 8, 2);
            $table->decimal('netTotal', 8, 2);
            $table->decimal('tax', 8, 2);
            $table->decimal('total', 8, 2);
            $table->decimal('roundOff', 8, 2);
            $table->decimal('payable', 8, 2);

            $table->string('shipping_address');
            $table->string('status')->default('pending');
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
};
