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
        Schema::create('labels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User who created the label
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // The product selected
            $table->string('used_by')->nullable(); // "Used By" field
            $table->string('prepared_by_name'); // Name of the person who prepared it
            $table->date('date'); // Date on the label
            $table->integer('qty'); // Quantity
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labels');
    }
};
