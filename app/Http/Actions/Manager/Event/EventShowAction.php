<?php

namespace App\Http\Actions\Manager\Event;

use App\Http\Controllers\Controller;
use App\Services\EventService;
use App\Services\Impl\EventServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EventShowAction extends Controller
{
    protected EventService $eventService;

    public function __construct(EventServiceInterface $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     *
     * @param Request $request
     * @param int $id
     * @return View
     */
    public function __invoke(Request $request, int $id): View
    {
        return view('manager.event.show', $this->eventService->getEventDetails($id));
    }
}
