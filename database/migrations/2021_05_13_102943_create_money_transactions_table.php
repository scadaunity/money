<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('account')->references('id')->on('money_accounts')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('category')->references('id')->on('money_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->date('date')->nullable();
            $table->decimal('amount',15,2)->nullable()->default(0);
            $table->boolean('pending')->default(false);
            $table->string('type')->nullable();
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
        Schema::dropIfExists('money_transactions');
    }
}
