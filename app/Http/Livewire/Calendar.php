<?php

namespace App\Http\Livewire;

use App\Http\Services\EventService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Carbon\Carbon;

class Calendar extends Component
{
    public Carbon $selectedDate;
    public array $dayInfoForOneWeekList;
    public Collection $selectedDateReEvents;
    protected EventService $eventService;

    public function mount(EventService $eventService)
    {
        $this->selectedDate = Carbon::today();
        $this->eventService = $eventService;

        $this->dayInfoForOneWeekList = $eventService->returnDayInfoForOneWeekToSelect($this->selectedDate);
        $this->selectedDateReEvents = $eventService->returnReEventsToSelect($this->selectedDate);
    }

    public function returnOneWeekForSelectedDate(string $selectedDate, EventService $eventService)
    {
        $this->selectedDate = Carbon::parse($selectedDate);
        $this->eventService = $eventService;

        $this->dayInfoForOneWeekList = $eventService->returnDayInfoForOneWeekToSelect($this->selectedDate);
        $this->selectedDateReEvents = $eventService->returnReEventsToSelect($this->selectedDate);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.calendar');
    }
}
