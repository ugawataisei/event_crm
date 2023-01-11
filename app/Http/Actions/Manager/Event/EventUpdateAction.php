<?php

namespace App\Http\Actions\Manager\Event;

use App\Consts\EventConst;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\Event\EventUpdateRequest;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;

class EventUpdateAction extends Controller
{
    /**
     *
     * @param EventUpdateRequest $request
     * @return RedirectResponse
     */
    public function __invoke(EventUpdateRequest $request): RedirectResponse
    {
        $startDate = $request->get('event_date') . ' ' . $request->get('start_time');
        $endDate = $request->get('event_date') . ' ' . $request->get('end_time');

        /** @var Event $model */
        Event::query()->findOrFail((int)$request->get('id'))
            ->fill([
                'name' => $request->get('name'),
                'information' => $request->get('information'),
                'start_time' => Carbon::parse($startDate),
                'end_date' => Carbon::parse($endDate),
                'max_people' => EventConst::MAX_PEOPLE_OPTION[(int)$request->get('max_people')],
                'is_visible' => $request->get('is_visible'),
            ])->save();

        return redirect()->route('manager.event.edit', ['id' => $request->get('id')])->with([
            'status' => 'info',
            'message' => trans('message.common.success_update'),
        ]);
    }
}
