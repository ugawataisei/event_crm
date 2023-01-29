<?php

namespace App\Http\Actions\User\MyPage;

use App\Http\Controllers\Controller;
use App\Services\MyPageService;
use App\Services\Impl\MyPageServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MyPageIndexAction extends Controller
{
    protected MyPageService $myPageService;

    public function __construct(MyPageServiceInterface $myPageService)
    {
        $this->myPageService = $myPageService;
    }

    /**
     *
     * @param Request $request
     * @return View
     */
    public function __invoke(Request $request): View
    {
        $reservedEvents = $this->myPageService->getAllReservedEvents();

        return view('user.my-page.index', compact('reservedEvents'));
    }
}
