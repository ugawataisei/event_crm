<?php

namespace App\Http\Actions\User;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardAction extends Controller
{
    /**
     *
     * @param Request $request
     * @return View
     */
    public function __invoke(Request $request): View
    {
        return view('dashboard');
    }
}
