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
        Schema::create('reports', function (Blueprint $table) {
            //$table->id();
            //$table->timestamps();

            $table->id('report_id'); // Set the column name specifically to 'report_id'
            $table->string('title', 255);
            //$table->string('report_type', 100)->nullable();
            $table->foreignId('alumni_id'); // Assuming 'alumni_id' is a foreign key
            //$table->integer('generated_by')->nullable();
            //$table->timestamp('generated_at')->useCurrent();
            //$table->string('status', 100)->default('generated'); // Default status
            $table->mediumText('content')->nullable();
            $table->text('summary')->nullable();
            $table->string('data_source', 255)->nullable();
            $table->string('version', 50)->nullable();
            $table->timestamps(); // This adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
