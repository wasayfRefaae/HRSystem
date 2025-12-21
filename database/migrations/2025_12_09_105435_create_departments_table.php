<?php

use App\Models\Employee;
use App\Models\Ministry;
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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
               $table->string('name');
            $table->foreignIdFor(Ministry::class)->constrained()->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->foreignId('manager_id')->nullable()->constrained('users');
         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};