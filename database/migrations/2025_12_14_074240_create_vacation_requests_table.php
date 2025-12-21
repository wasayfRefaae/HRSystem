<?php

use App\Models\User;
use App\Models\Vacation;
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
        Schema::create('vacation_requests', function (Blueprint $table) {
            $table->id();
                             $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
             $table->foreignIdFor(Vacation::class)->constrained()->cascadeOnDelete();
            $table->string('request_date')->default(now()->toDateString())->nullable();
            $table->year('year')->default(now()->year);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('vac_days')->nullable();
            $table->integer('vac_months')->nullable();
            $table->integer('days_per_year')->nullable();
            $table->integer('used_days')->nullable();
            $table->integer('remain_days')->nullable();
            $table->text('reason')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('notes')->nullable();
            $table->string('doc_no')->nullable();
            $table->date('doc_date')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamp('approved_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacation_requests');
    }
};