<?php

namespace App\Http\Actions\Manager\Event;

use App\Consts\EventConst;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\Event\EventStoreRequest;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;

class EventStoreAction extends Controller
{
    /**
     *
     * @param EventStoreRequest $request
     * @return RedirectResponse
     */
    public function __invoke(EventStoreRequest $request): RedirectResponse
    {
        $startDate = $request->get('event_date') . ' ' . $request->get('start_time');
        $endDate = $request->get('event_date') . ' ' . $request->get('end_time');

        /** @var Event $model */
        $model = Event::query()->create([
            'name' => $request->get('name'),
            'information' => $request->get('information'),
            'start_date' => Carbon::parse($startDate),
            'end_date' => Carbon::parse($endDate),
            'max_people' => EventConst::MAX_PEOPLE_OPTION[(int)$request->get('max_people')],
            'is_visible' => $request->get('is_visible'),
        ]);

        return redirect()->route('manager.event.edit', ['id' => $model->id])->with([
            'status' => 'info',
            'message' => trans('message.common.success_store'),
        ]);
    }
}
