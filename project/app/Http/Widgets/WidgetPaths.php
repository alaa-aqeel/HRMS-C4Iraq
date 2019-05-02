<?php

namespace App\Http\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;
use App\Paths;

class WidgetPaths extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = Paths::count();
        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-move',
            'title'  => "{$count} Paths",
            'text'   => "We have {$count} Paths to teach",
            'button' => [
                'text' => 'View All Paths',
                'link' => route('voyager.paths.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/03.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse',new Paths() );
    }
}
