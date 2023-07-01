<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use App\Models\Employee;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use Carbon\Carbon;

class ViewEmployee extends ViewRecord
{
    protected static string $resource = EmployeeResource::class;

    protected static ?string $title = 'Employee Details';

    public function mount($record): void
    {
        static::authorizeResourceAccess();

        $this->record = $this->resolveRecord($record);

        abort_unless(static::getResource()::canView($this->getRecord()), 403);

        $this->fillForm();

    }

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make()
                ->size('sm'),
            Actions\DeleteAction::make()
                ->size('sm'),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make(8)
                ->schema([
                    Card::make()
                        ->columnSpan(2)
                        ->schema([
                            Placeholder::make('picture')
                                ->label('Gambar')
                                ->content(view('components.images.index', ['post' => Employee::showImage($this->record->id)])),
                        ]),
                    Card::make()
                        ->columns(2)
                        ->columnSpan(6)
                        ->schema([
                            Placeholder::make('full_name')
                                ->label('Full Name')
                                ->content($this->record->first_name. ' '. $this->record->last_name ?? '-'),
                            Placeholder::make('country_name')
                                ->label('Country')
                                ->content($this->record->country->name ?? '-'),
                            Placeholder::make('state_name')
                                ->label('State')
                                ->content($this->record->state->name ?? '-'),
                            Placeholder::make('city_name')
                                ->label('City')
                                ->content($this->record->city->name ?? '-'),
                            Placeholder::make('department_name')
                                ->label('Department')
                                ->content($this->record->department->name ?? '-'),
                            Placeholder::make('address')
                                ->label('Address')
                                ->content($this->record->address ?? '-'),
                            Placeholder::make('birth_date')
                                ->label('Birth Date')
                                ->content($this->record->birth_date ? Carbon::parse($this->record->birth_date)->isoFormat('dddd, D MMMM Y')
                                    : '-'),
                            Placeholder::make('date_hired')
                                ->label('Hired Date')
                                ->content($this->record->date_hired ? Carbon::parse($this->record->date_hired)->isoFormat('dddd, D MMMM Y')
                                    : '-'),
                        ])
                ]),
        ];
    }
}
