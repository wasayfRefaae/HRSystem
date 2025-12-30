<?php

namespace App\Filament\Hr\Resources\VacationRequests\Pages;

use App\Filament\Hr\Resources\VacationRequests\VacationRequestResource;
use App\Notifications\VacationApprovedNotification;
use App\Notifications\VacationRejectedNotification;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;




    class EditVacationRequestWithNotifications extends EditRecord
    {
        protected static string $resource = VacationRequestResource::class;

        protected function handleRecordUpdate(Model $record, array $data): Model
        {
            $oldStatus = $record->status;
            $newStatus = $data['status'] ?? $oldStatus;

            $record->update($data);

            // Send notifications only when status changes from pending
            if ($oldStatus === 'pending' && $newStatus === 'approved') {
                $record->user->notify(new VacationApprovedNotification($record));
            } elseif ($oldStatus === 'pending' && $newStatus === 'rejected') {
                $record->user->notify(new VacationRejectedNotification($record));
            }

            return $record;
        }

        protected function getSavedNotificationTitle(): ?string
        {
            return 'Vacation request updated and notification sent';
        }

        protected function getHeaderActions(): array
        {
            return [
                DeleteAction::make(),
            ];
        }
    
   
}