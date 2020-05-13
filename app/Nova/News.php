<?php

namespace App\Nova;

use Benjaminhirsch\NovaSlugField\Slug;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Digitalcloud\MultilingualNova\Multilingual;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Trix;
use Illuminate\Http\File;
use NovaButton\Button;
class News extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\News';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Multilingual::make('Languages')->hideFromIndex(),
            TextWithSlug::make('Title(Lang)','title')->slug('slug')->hideFromIndex(),
            Slug::make('Slug','slug')->hideFromIndex(),
            Textarea::make('Description(Lang)','description')->hideFromIndex(),
            Text::make('Source','source')->readonly(),
               Select::make('Country(Lang)','country') ->options(\App\Locations::all()->mapWithKeys(function ($person) {
                return [$person->title => $person->title];
            }))->displayUsingLabels(),
            Image::make('Image','image')->disk('public'),
           Text::make('Video','video')->hideFromIndex(),
            Trix::make('Text(Lang)','text')->hideFromIndex(),
            Select::make('Type','type')->options([
                'local' => 'Local',
                'worldwide' => 'Worldwide',
            ])->hideFromIndex(),
                    Select::make('Sources(Lang)','source') ->options(\App\Sources::all()->mapWithKeys(function ($person) {
                return [$person->title => $person->title];
            }))->displayUsingLabels(),
            BelongsTo::make('Cat', 'Cat', 'App\Nova\Cat'),
            Boolean::make('Interesting','interesting'),
            Boolean::make('Add Main Slide','add_main_slide'),
                       Button::make('POST TO telegram')->event('App\Events\SendNewsToChanell'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
