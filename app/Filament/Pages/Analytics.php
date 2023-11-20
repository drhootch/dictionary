<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Analytics extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static string $view = 'filament.pages.analytics';

    protected static ?int $navigationSort = 4;

    public function getTitle(): string | Htmlable
    {
        return __('Analytics');
    }

    public static function getNavigationLabel(): string
    {
        return __('Analytics');
    }
}
