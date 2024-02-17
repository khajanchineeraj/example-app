<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\Page;

class SortUsers extends Page
{
    protected static string $resource = UserResource::class;

//    protected static string $view = 'filament.resources.user-resource.pages.sort-users';

    public function activityTimelineInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->state([
                'activities' => [
                    [
                        'title' => "Published Article 🔥 - <span class='italic font-normal dark:text-success-400 text-success-600'>Published with Laravel Filament and Tailwind CSS</span>",
                        'description' => "<span>Approved and published. Here is the <a href='#' class='font-bold hover:underline dark:text-orange-300'>link.</a></span>",
                        'status' => 'published',
                        'created_at' => now()->addDays(8),
                    ],
                    [
                        'title' => 'Reviewing Article - Final Touches',
                        'description' => "<span class='italic'>Reviewing the article and making it ready for publication.</span>",
                        'status' => '',
                        'created_at' => now()->addDays(5),
                    ],
                    [
                        'title' => "Drafting Article - <span class='text-sm italic font-normal text-purple-800 dark:text-purple-300'>Make it ready for review</span>",
                        'description' => 'Drafting the article and making it ready for review.',
                        'status' => 'drafting',
                        'created_at' => now()->addDays(2),
                    ],
                    [
                        'title' => 'Ideation - Looking for Ideas 🤯',
                        'description' => 'Idea for my article.',
                        'status' => 'ideation',
                        'created_at' => now()->subDays(7),
                    ]
                ]
            ])
            ->schema([

                /*
                   You should enclose the entire components within a personalized "ActivitySection" entry.
                   This section functions identically to the repeater entry; you simply have to provide the array state's key.
                */

                ActivitySection::make('activities')
                    ->label('My Activities')
                    ->description('These are the activities that have been recorded.')
                    ->schema([
                        ActivityTitle::make('title')
                            ->placeholder('No title is set')
                            ->allowHtml(), // Be aware that you will need to ensure that the HTML is safe to render, otherwise your application will be vulnerable to XSS attacks.
                        ActivityDescription::make('description')
                            ->placeholder('No description is set')
                            ->allowHtml(),
                        ActivityDate::make('created_at')
                            ->date('F j, Y', 'Asia/Manila')
                            ->placeholder('No date is set.'),
                        ActivityIcon::make('status')
                            ->icon(fn (string | null $state): string | null => match ($state) {
                                'ideation' => 'heroicon-m-light-bulb',
                                'drafting' => 'heroicon-m-bolt',
                                'reviewing' => 'heroicon-m-document-magnifying-glass',
                                'published' => 'heroicon-m-rocket-launch',
                                default => null,
                            })
                            ->color(fn (string | null $state): string | null => match ($state) {
                                'ideation' => 'purple',
                                'drafting' => 'info',
                                'reviewing' => 'warning',
                                'published' => 'success',
                                default => 'gray',
                            }),
                    ])
                    ->showItemsCount(2) // Show up to 2 items
                    ->showItemsLabel('View Old') // Show "View Old" as link label
                    ->showItemsIcon('heroicon-m-chevron-down') // Show button icon
                    ->showItemsColor('gray') // Show button color and it supports all colors
                    ->aside(true)
                    ->headingVisible(true) // make heading visible or not
                    ->extraAttributes(['class'=>'my-new-class']) // add extra class
            ]);
    }
}
