<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use App\Models\Employee;
use Filament\Actions;
use Filament\Forms\Components\Builder;
// use Filament\Infolists\Components\Tabs\Tab;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array 
    {
        return [
            'All' => Tab::make()
            ->badge(Employee::query()->count()),
            'This Week' => Tab::make()->modifyQueryUsing(fn (EloquentBuilder $query) => $query->where('date_hired','>=',now()->subWeek()))
            ->badge(Employee::query()->where('date_hired','>=',now()->subWeek())->count()),
            'This Month' => Tab::make()->modifyQueryUsing(fn (EloquentBuilder $query) => $query->where('date_hired','>=',now()->subMonth()))
            ->badge(Employee::query()->where('date_hired','>=',now()->subMonth())->count()),
            'This Year' => Tab::make()->modifyQueryUsing(fn (EloquentBuilder $query) => $query->where('date_hired','>=',now()->subYear()))
            ->badge(Employee::query()->where('date_hired','>=',now()->subYear())->count()),
        ];
    }
}
