<?php

namespace App\Http\Actions\Manager\Event;

use App\Consts\EventConst;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class EventUpdateAction extends Controller
{
    /**
     *
     * @param Request $request
     * @return View
     */
    public function __invoke(Request $request): View
    {
        dd($request);
        /** @var Collection $models */
        $models = Event::query()->where('is_visible', EventConst::STATUS_DISPLAY)
            ->whereDate('start_date', '>', Carbon::now('Asia/Tokyo'))
            ->get();

        return view('manager.event.index', compact('models'));
    }
}
