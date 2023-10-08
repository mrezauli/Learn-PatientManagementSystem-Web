<?php

namespace App\Filament\Resources\PatientResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\PatientResource;

class EditPatient extends EditRecord
{
    protected static string $resource = PatientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\Action::make('impersonate')
                ->action(function (): void {
                    // ...
                }),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            ...parent::getFormActions(),
            Action::make('close')->action('saveAndClose'),
        ];
    }

    public function saveAndClose(): void
    {
        // ...
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['updated_by'] = auth()->id();

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['updated_by'] = auth()->id();

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);

        return $record;
    }

    // protected function getRedirectUrl(): string
    // {
    //     return $this->getResource()::getUrl('index');
    // }

    // protected function getRedirectUrl(): string
    // {
    //     return $this->getResource()::getUrl('view', ['record' => $this->getRecord()]);
    // }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'User updated';
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User updated')
            ->body('The user has been saved successfully.');
    }

    // protected function getSavedNotification(): ?Notification
    // {
    //     return null;
    // }

    protected function beforeFill(): void
    {
        // Runs before the form fields are populated from the database.
    }

    protected function afterFill(): void
    {
        // Runs after the form fields are populated from the database.
    }

    protected function beforeValidate(): void
    {
        // Runs before the form fields are validated when the form is saved.
    }

    protected function afterValidate(): void
    {
        // Runs after the form fields are validated when the form is saved.
    }

    protected function beforeSave(): void
    {
        // Runs before the form fields are saved to the database.
        $this->halt();
    }

    protected function afterSave(): void
    {
        // Runs after the form fields are saved to the database.
    }
}
