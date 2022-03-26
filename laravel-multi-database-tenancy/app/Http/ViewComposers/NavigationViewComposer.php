<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class NavigationViewComposer
{
    public function compose(View $view)
    {
        if (auth()->check()) {
            $view->with('companies', auth()->user()->companies);
        }
    }
}
