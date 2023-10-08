<?php

namespace App\Filament\Resources\PatientResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Wizard\Step;
use Filament\Notifications\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PatientResource;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms;
use Filament\Tables;
use App\Models\Patient;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PatientResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PatientResource\RelationManagers\TreatmentsRelationManager;

class CreatePatient extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = PatientResource::class;

    public function hasSkippableSteps(): bool
    {
        return true;
    }

    protected function getSteps(): array
    {
        return [
            Step::make('owner_id')
                ->description('owner_id')
                ->schema([
                    PatientResource::getOwnerFormField(),

                ]),
            Step::make('date_of_birth')
                ->description('date_of_birth')
                ->schema([
                    PatientResource::getDate_of_birthFormField(),

                ]),
            Step::make('name')
                ->description('name')
                ->schema([
                    PatientResource::getNameFormField(),

                ]),
            Step::make('type')
                ->description('type')
                ->schema([
                    PatientResource::getTypeFormField(),
                ]),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        return static::getModel()::create($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Patient registered';
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Patient registered')
            ->body('The patient has been created successfully.');
    }

    // protected function getCreatedNotification(): ?Notification
    // {
    //     return null;
    // }

    protected function beforeFill(): void
    {
        // Runs before the form fields are populated with their default values.
    }

    protected function afterFill(): void
    {
        // Runs after the form fields are populated with their default values.
    }

    protected function beforeValidate(): void
    {
        // Runs before the form fields are validated when the form is submitted.
    }

    protected function afterValidate(): void
    {
        // Runs after the form fields are validated when the form is submitted.
    }

    protected function beforeCreate(): void
    {
        // Runs before the form fields are saved to the database.
        $this->halt();
    }

    protected function afterCreate(): void
    {
        // Runs after the form fields are saved to the database.
    }
}
