<?php

namespace Database\Seeders;

use App\Consts\EventConst;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DevEventSeeder extends Seeder
{
    public Carbon $today;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->today = Carbon::today();

        DB::table('events')->insert([
            [
                'name' => 'テストイベント1',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => EventConst::MAX_PEOPLE_OPTION[0],
                'start_date' => $this->today,
                'end_date' => $this->today->addHours(3),
                'is_visible' => EventConst::STATUS_DISPLAY,
            ],
            [
                'name' => 'テストイベント2',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => EventConst::MAX_PEOPLE_OPTION[1],
                'start_date' => $this->today->addDays(1),
                'end_date' => $this->today->addDays(1)->addHours(3),
                'is_visible' => EventConst::STATUS_DISPLAY,
            ],
            [
                'name' => 'テストイベント3',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => EventConst::MAX_PEOPLE_OPTION[2],
                'start_date' => $this->today->addDays(2),
                'end_date' => $this->today->addDays(2)->addHours(3),
                'is_visible' => EventConst::STATUS_DISPLAY,
            ],
            [
                'name' => 'テストイベント4',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => EventConst::MAX_PEOPLE_OPTION[3],
                'start_date' => $this->today->addDays(3),
                'end_date' => $this->today->addDays(3)->addHours(3),
                'is_visible' => EventConst::STATUS_DISPLAY,
            ],
            [
                'name' => 'テストイベント5',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => EventConst::MAX_PEOPLE_OPTION[1],
                'start_date' => $this->today->addDays(4),
                'end_date' => $this->today->addDays(4)->addHours(3),
                'is_visible' => EventConst::STATUS_DISPLAY,
            ],
            [
                'name' => 'テストイベント6',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => EventConst::MAX_PEOPLE_OPTION[3],
                'start_date' => $this->today->addDays(6),
                'end_date' => $this->today->addDays(6)->addHours(3),
                'is_visible' => EventConst::STATUS_DISPLAY,
            ],
            [
                'name' => 'テストイベント7',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => EventConst::MAX_PEOPLE_OPTION[3],
                'start_date' => $this->today->addDays(8),
                'end_date' => $this->today->addDays(8)->addHours(3),
                'is_visible' => EventConst::STATUS_DISPLAY,
            ],
        ]);
    }
}
