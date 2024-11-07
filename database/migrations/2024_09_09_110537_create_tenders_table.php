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
        Schema::create('tenders', function (Blueprint $table) {
            $table->uuid();
            $table->string('title');
            $table->text('description');
            $table->string('reference_number')->unique();  
            $table->uuid('created_by'); 
            $table->date('posting_date');  
            $table->date('start_date');    
            $table->datetime('end_date');
            $table->uuid('project');
            $table->uuid('donor');
            $table->string('type'); 
            $table->string('t_type');
            $table->string('document')->nullable(); 
            $table->boolean('archived')->default(0); // Archived flag (0 for active, 1 for archived)
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenders');
    }
};
