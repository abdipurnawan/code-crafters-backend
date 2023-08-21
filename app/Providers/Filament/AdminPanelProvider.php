<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use LaraZeus\Sky\Editors\TipTapEditor;
use LaraZeus\Sky\SkyPlugin;
use Spatie\Translatable\Translatable;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return
            $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
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
            ])
            ->plugins([
                SkyPlugin::make()
                    ->skyPrefix('sky')
                    ->skyMiddleware(['web'])
                    ->uriPrefix([
                        'post' => 'post',
                        'page' => 'page',
                        'library' => 'library',
                        'faq' => 'faq',
                    ])

                    // enable or disable the resources
                    // ->hasPostResource()
                    // ->hasPageResource()
                    // ->hasFaqResource()
                    // ->hasLibraryResource(false)

                    ->navigationGroupLabel('Menus')

                    // the default models
                    ->faqModel(\LaraZeus\Sky\Models\Faq::class)
                    ->postModel(\LaraZeus\Sky\Models\Post::class)
                    ->postStatusModel(\LaraZeus\Sky\Models\PostStatus::class)
                    ->tagModel(\LaraZeus\Sky\Models\Tag::class)
                    ->libraryModel(\LaraZeus\Sky\Models\Library::class)

                    ->editor(TipTapEditor::class)
                    ->parsers([\LaraZeus\Sky\Classes\BoltParser::class])
                    ->recentPostsLimit(5)
                    ->searchResultHighlightCssClass('highlight')
                    ->skipHighlightingTerms(['iframe'])
                    ->defaultFeaturedImage('url/to/image')
                    ->libraryTypes([
                        'FILE' => 'File',
                        'IMAGE' => 'Image',
                        'VIDEO' => 'Video',
                    ])
                    ->tagTypes([
                        'tag' => 'Tag',
                        'category' => 'Category',
                        'library' => 'Library',
                        'faq' => 'Faq',
                    ]),
                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales(['en', 'es', 'fr']),


            ]);
    }
}
