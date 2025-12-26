<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    
   protected $guarded = [
        'id','created_at','updated_at','rememberToken','email_verified_at',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
              'sex' => 'boolean',
        'wife' => 'boolean',
       'child1' => 'boolean',
        'child2' => 'boolean',
        'child3' => 'boolean',
        'uni' => 'boolean',
        'social_box' => 'boolean',
        'birth_date' => 'date',
        'hire_date' => 'date',
        'app_date'=> 'date',
        'salary' => 'decimal:2',
        ];
    }


    public function department(): BelongsTo
{
    return $this->belongsTo(Department::class);

    //
}

    public function work(): BelongsTo
{
    return $this->belongsTo(Work::class);

}
    public function position(): BelongsTo
{
    return $this->belongsTo(Position::class);

}

    public function category(): BelongsTo
{
    return $this->belongsTo(Category::class);

}
    public function degree(): BelongsTo
{
    return $this->belongsTo(Degree::class);

}
        public function vacationRequest(): HasMany
    {
        return $this->hasMany(VacationRequest::class);
    }
           public function incidentRequest(): HasMany
    {
        return $this->hasMany(IncidentRequest::class);
    }

     public function division(): BelongsTo
{
    return $this->belongsTo(Division::class);

    
}
public function departmentColleagues():HasMany
{
    return $this->hasMany(User::class, 'department_id', 'department_id');
               // ->where('id', '!=', $this->id);
}
 public function isManager(): bool
    {
         return Department::where('manager_id', Auth::user()->id)->value('manager_id');
    }

 protected static function boot()
    {
        parent::boot();
        //EMP-0001

        static::creating(function ($employee) {
            if (empty($employee->employee_id)) {
                $lastEmployee = static::orderBy('id','desc')->first(); 

                $nextNumber = 1;

                if ($lastEmployee && $lastEmployee->employee_id) {
                    if (preg_match('/^EMP-(\d+)$/', $lastEmployee->employee_id,$matches)) {
                        $nextNumber = ((int) $matches[1]) + 1;
                    }
                }

                $employee->employee_id = 'EMP-' . str_pad($nextNumber, 6,'0', STR_PAD_LEFT);
            }
        });
    }

}