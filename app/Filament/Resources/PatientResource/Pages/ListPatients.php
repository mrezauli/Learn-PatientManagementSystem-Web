<?php

namespace App\Filament\Resources\PatientResource\Pages;

use Filament\Actions;
use App\Models\Patient;
use App\Models\Customer;
use Filament\Tables\Table;
use Filament\Support\Enums\IconPosition;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PatientResource;
use Filament\Resources\Pages\ListRecords\Tab;

class ListPatients extends ListRecords
{
    protected static string $resource = PatientResource::class;

    //protected static string $view = 'filament.resources.users.pages.list-users';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // public function table(Table $table): Table
    // {
    //     return $table
    //         ->modifyQueryUsing(fn (Builder $query) => $query->withoutGlobalScopes());
    // }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All patients')
                ->icon('heroicon-m-user-group')
                ->iconPosition(IconPosition::After),
            'cat' => Tab::make('Cat')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'cat')),
            'dog' => Tab::make('Dog')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'dog'))
                ->badge(Patient::query()->where('type', 'dog')->count()),
            'rabbit' => Tab::make('Rabbit')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'rabbit')),
        ];
    }
}
