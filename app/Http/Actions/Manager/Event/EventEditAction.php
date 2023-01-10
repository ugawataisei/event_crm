<?php

namespace App\Http\Actions\Manager\Event;

use App\Models\Event;
use App\Consts\EventConst;
use Illuminate\Contracts\View\View;

class EventEditAction
{
    /**
     *
     * @param int $id
     * @return View
     */
    public function __invoke(int $id): View
    {
        /** @var Event $model */
        $model = Event::query()
            ->findOrFail($id);

        $viewParams = [
            'model' => $model,
            'oldKey' => array_search($model->max_people, EventConst::MAX_PEOPLE_OPTION),
            'event_date' => $model->start_date->format('Y年m月d日'),
            'start_time' => $model->start_date->format('H時m分'),
            'end_time' => $model->end_date->format('H時m分'),
        ];

        return view('manager.event.edit', $viewParams);
    }
}
