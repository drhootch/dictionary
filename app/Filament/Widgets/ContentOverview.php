<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContentOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(__('Discovered contexts'), '192')->url(route('filament.validator.resources.entries.index')),
            Stat::make(__('Entries'), '145')->url(route('filament.validator.resources.words.index')),
            Stat::make(__('Relations'), '67')->url(route('filament.validator.resources.relations.index')),
        ];
    }
}
