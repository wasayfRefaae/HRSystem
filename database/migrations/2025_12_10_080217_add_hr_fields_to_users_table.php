<?php

use App\Models\Category;
use App\Models\Degree;
use App\Models\Department;
use App\Models\Division;
use App\Models\Position;
use App\Models\Work;
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
        Schema::table('users', function (Blueprint $table) {
              $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();   
            $table->string('last_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->enum('sex', ['ذكر', 'أنثى'])->default('ذكر');
            $table->string('pers_no')->nullable();//رقم الهوية
            $table->string('national_no')->nullable();//الرقم الوطني
            $table->enum('family_status', ['أعزب', 'متزوج', 'أرمل', 'مطلق'])->default('أعزب')->nullable();
            $table->boolean('wife')->nullable();
            $table->boolean('child1')->nullable();
            $table->boolean('child2')->nullable();
            $table->boolean('child3')->nullable();
            $table->integer('child_no')->nullable();
            $table->boolean('uni')->nullable();//مشترك بنقابة العمال
            $table->boolean('social_box')->nullable();//مشترك بصندوق التكافل الاجتماعي
            $table->string('nationality')->nullable();//الجنسية 
            $table->string('reg_date_num')->nullable();//رقم وتاريخ القيد
            $table->string('image_url')->nullable();
            $table->foreignIdFor(Category::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Degree::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Department::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Position::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Work::class)->nullable()->constrained()->cascadeOnDelete();
          $table->foreignIdFor(Division::class)->nullable()->constrained()->cascadeOnDelete();
            $table->integer('vacation_days')->nullable();
            $table->string('employee_id')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->date('birth_date')->nullable();
            $table->date('hire_date')->nullable();//تاريخ المباشرة
             $table->string('appoint_no')->nullable();//رقم قرار التعيين
             $table->date('app_date')->nullable();//تاريخ التعييين
            $table->string('hire_no')->nullable();//رقم قرار التعيين
            $table->string('shamCash_no')->nullable();//رقم حساب شام كاش
             $table->integer('days_he_fiveYears')->nullable();//مجموع صحية لخمس سنوات
            $table->integer('days_not_fiveYears')->nullable();//مجموع بلا اجر لخمس سنوات
            $table->enum('employment_type', ['full-time', 'part-time', 'contract', 'intern'])->default('full-time');
            $table->enum('status', ['active', 'إنهاء خدمة', 'استقالة', 'بحكم المستقيل'])->default('على رأس عمله');
            $table->decimal('salary', 10, 2)->nullable();
            $table->text('address')->nullable();
            
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};