<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('MI Poultry')
            ->font('Cairo')
            ->colors([
                'primary' => Color::hex('#C8102E'),
                'danger'  => Color::hex('#A50C24'),
                'warning' => Color::hex('#B8945C'),
                'success' => Color::hex('#2F6B4F'),
                'info'    => Color::hex('#3D5A80'),
                'gray'    => Color::Stone,
            ])
            ->darkMode(false)
            ->sidebarCollapsibleOnDesktop()
            ->maxContentWidth(MaxWidth::Full)
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->navigationGroups([
                // Daily work first — inbox
                NavigationGroup::make()
                    ->label('الواردات')
                    ->icon('heroicon-o-inbox-stack')
                    ->collapsed(false),

                // Core business catalog
                NavigationGroup::make()
                    ->label('المنتجات والمشاريع')
                    ->icon('heroicon-o-building-storefront')
                    ->collapsed(false),

                // Homepage / landing sections
                NavigationGroup::make()
                    ->label('واجهة الموقع')
                    ->icon('heroicon-o-computer-desktop')
                    ->collapsed(),

                // Trust signals
                NavigationGroup::make()
                    ->label('الثقة والسمعة')
                    ->icon('heroicon-o-shield-check')
                    ->collapsed(),

                // Editorial content
                NavigationGroup::make()
                    ->label('المدونة والصفحات')
                    ->icon('heroicon-o-newspaper')
                    ->collapsed(),

                // System config last
                NavigationGroup::make()
                    ->label('الإعدادات')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->collapsed(),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->plugins([
                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales(['ar', 'en']),
            ])
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): HtmlString => new HtmlString(<<<'HTML'
                    <style>
                        :root {
                            --mi-admin-ink: #1A1611;
                            --mi-admin-cream: #FBF7EF;
                        }
                        .fi-sidebar-nav {
                            scrollbar-gutter: stable;
                        }
                        .fi-sidebar-group-label {
                            font-size: 0.7rem !important;
                            letter-spacing: 0.04em;
                            text-transform: none !important;
                            font-weight: 700 !important;
                            color: #7A6E63 !important;
                        }
                        .fi-sidebar-item-button {
                            border-radius: 0.625rem !important;
                        }
                        .fi-sidebar-item-button:hover {
                            background-color: rgba(200, 16, 46, 0.06) !important;
                        }
                        .fi-sidebar-item-active .fi-sidebar-item-button,
                        .fi-sidebar-item-button[aria-current="page"] {
                            background-color: rgba(200, 16, 46, 0.1) !important;
                        }
                        .fi-main,
                        .fi-body {
                            background-color: var(--mi-admin-cream) !important;
                        }
                        .fi-header-heading {
                            font-weight: 800 !important;
                            color: var(--mi-admin-ink) !important;
                        }
                        .fi-wi-stats-overview-stat {
                            border-radius: 0.875rem !important;
                        }
                        .fi-section,
                        .fi-ta,
                        .fi-fo-component-ctn {
                            border-radius: 0.875rem;
                        }
                        .fi-btn-primary {
                            font-weight: 600;
                        }
                        /* Tighten dense sidebar lists */
                        .fi-sidebar-nav-groups {
                            gap: 0.35rem !important;
                        }
                    </style>
                HTML)
            )
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
