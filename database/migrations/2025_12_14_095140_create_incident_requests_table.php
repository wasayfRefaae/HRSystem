<?php

use App\Models\Category;
use App\Models\Department;
use App\Models\Incident;
use App\Models\Ministry;
use App\Models\Position;
use App\Models\User;
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
        Schema::create('incident_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Incident::class)->constrained()->cascadeOnDelete();
        $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
        $table->foreignIdFor(Ministry::class)->constrained()->cascadeOnDelete();
        $table->foreignIdFor(Department::class)->constrained()->cascadeOnDelete();
        $table->foreignIdFor(Position::class)->constrained()->cascadeOnDelete();
        $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
        $table->date('hire_date')->nullabel();
        $table->decimal('salary', 10, 2)->nullable();
        $table->string('doc_no');
        $table->date('doc_date');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_requests');
    }
};