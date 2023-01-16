<?php

namespace App\Http\Actions\Manager\Event;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EventCreateAction extends Controller
{
    /**
     *
     * @param Request $request
     * @return View
     */
    public function __invoke(Request $request): View
    {
        return view('manager.event.create');
    }
}
