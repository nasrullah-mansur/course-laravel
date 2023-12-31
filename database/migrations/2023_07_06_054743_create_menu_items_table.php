<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->integer('p_id')->default('0');
            $table->string('label')->nullable();
            $table->string('slug')->default('/');
            $table->string('class')->nullable();
            $table->string('target')->default('_self');

            $table->string('status')->default(STATUS_ACTIVE);
            $table->timestamps();
            // $table->timestamp('created_at')->useCurrent();
            // $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
