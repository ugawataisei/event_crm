<?php

namespace App\Http\Actions\Manager\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventDeleteAction extends Controller
{
    /**
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
    {
        /** @var Event $model */
        $model = Event::query()->findOrFail($request->get('id'));

        if ($model === null) {
            return redirect()->route('manager.event.index')->with([
                'status' => 'alert',
                'message' => trans('message.common.error_actions'),
            ]);
        }

        $model->delete();

        return redirect()->route('manager.event.index')->with([
            'status' => 'info',
            'message' => trans('message.common.success_delete'),
        ]);
    }
}
