<?php

namespace App\Http\Livewire;

use App\Services\LivewireService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Calendar extends Component
{
    public Carbon $selectedDate;
    public array $dayInfoForOneWeekList;
    public Collection $selectedDateReEvents;
    protected LivewireService $livewireService;

    public function mount(LivewireService $livewireService): void
    {
        $this->selectedDate = Carbon::today();
        $this->livewireService = $livewireService;

        $this->dayInfoForOneWeekList = $livewireService->returnDayInfoForOneWeekToSelect($this->selectedDate);
        $this->selectedDateReEvents = $livewireService->returnReEventsToSelect($this->selectedDate);
    }

    public function returnOneWeekForSelectedDate(string $selectedDate, LivewireService $livewireService): void
    {
        $this->selectedDate = Carbon::parse($selectedDate);
        $this->livewireService = $livewireService;

        $this->dayInfoForOneWeekList = $livewireService->returnDayInfoForOneWeekToSelect($this->selectedDate);
        $this->selectedDateReEvents = $livewireService->returnReEventsToSelect($this->selectedDate);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.calendar');
    }
}
