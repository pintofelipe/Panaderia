<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->string('registered_by')->nullable();
            $table->string('status')->nullable();
            $table->decimal('price', 8, 2);
            $table->integer('quantity')->default(0)->nullable();
        

            $table->unsignedBigInteger('provider_id')->nullable();
            $table->foreign('provider_id')
                ->references('id')
                ->on('providers');
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
