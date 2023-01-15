<?php

namespace App\Http\Actions\Manager\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Consts\EventConst;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EventEditAction extends Controller
{
    /**
     *
     * @param Request $request
     * @param int $id
     * @return View
     */
    public function __invoke(Request $request, int $id): View
    {
        /** @var Event $model */
        $model = Event::query()
            ->findOrFail($id);

        $viewParams = [
            'model' => $model,
            'oldMaxPeopleKey' => array_search($model->max_people, EventConst::MAX_PEOPLE_OPTION),
            'oldIsVisibleKey' => $model->is_visible,
            'event_date' => $model->start_date->format('Y年m月d日'),
            'start_time' => $model->start_date->format('H時m分'),
            'end_time' => $model->end_date->format('H時m分'),
        ];

        return view('manager.event.edit', $viewParams);
    }
}
