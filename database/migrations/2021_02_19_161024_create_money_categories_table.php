<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('team')->constrained('teams')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('money_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->boolean('state')->nullable();
            $table->boolean('type')->nullable();
            $table->string('color')->nullable();
            $table->string('icon')->nullable();
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
        Schema::dropIfExists('money_categories');
    }
}
