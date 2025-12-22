<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;


use App\Models\User;
use App\Models\Vacation;
use App\Models\VacationRequest;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use DateTime;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class CalculateVacationDays implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
  public $timeout = 300;
    public $tries = 3;
    public function __construct(public int $year,
        public ?int $userId = null)
    {
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Build employee query. If a specific userId is provided, restrict to that user.
        $employeesQuery = User::query();
           // ->where('name', '<>', 'Super Admin'); // exclude admin account

       

        $employees = $employeesQuery->get();

        foreach ($employees as $employee) {
            try {
                $now = Carbon::now();
                $year =  $now->year;

               $existingEmpVac = VacationRequest::where('user_id',$employee->id)
                ->where('year',$this->year);
             /*   if ($existingEmpVac) {
                    Log::info("Vacation  already exists for {$employee->name}  - {$this->year}");
                    continue;
                }
*/
                $hireDate = $employee->hire_date ;
               $hireDateCarbon = Carbon::parse($hireDate);
               $yearsOfService = $hireDateCarbon->diffInYears($now);
            


                    VacationRequest::create([
                        'user_id' => $employee->id,
                        'vacation_id' =>1,
                        'year' => $this->year,
                        'request_date'=> now()->toDateString(),
                        'days_per_year' =>$yearsOfService < 1 ? 15 : ($yearsOfService <= 5 ? 21 : ($yearsOfService <= 10 ? 26 : 30)),
                        'used_days'=>0,
           
                        'remain_days'=> $yearsOfService < 1 ? 15 : ($yearsOfService <= 5 ? 21 : ($yearsOfService <= 10 ? 26 : 30)),
                        
                    ]);
                    Log::info("Vacation request created for {$employee->name} - {$year}");
                
            } catch (\Exception $e) {
                Log::error("Error creating vacation request for {$employee->name} - {$this->year}: {$e->getMessage()}");
            }
        }
        Notification::make()
                ->success()
                ->title('Calculation Completed')
                ->body('Calculate for Employees Vacation For this year has been Finished')
                ->send(); 
    }
}