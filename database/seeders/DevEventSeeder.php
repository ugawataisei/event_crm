<?php

namespace Database\Seeders;

use App\Consts\EventConst;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\CarbonImmutable;

class DevEventSeeder extends Seeder
{
    public CarbonImmutable $today;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->today = CarbonImmutable::today();

        DB::table('events')->insert([
            [
                'name' => 'event1',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => EventConst::MAX_PEOPLE_OPTION[0],
                'start_date' => $this->today->addHours(10),
                'end_date' => $this->today->addHours(13),
                'is_visible' => EventConst::STATUS_DISPLAY,
                'created_at' => CarbonImmutable::now(),
            ],
            [
                'name' => 'event2',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => EventConst::MAX_PEOPLE_OPTION[1],
                'start_date' => $this->today->addDays(1)->addHours(12),
                'end_date' => $this->today->addDays(1)->addHours(15),
                'is_visible' => EventConst::STATUS_DISPLAY,
                'created_at' => CarbonImmutable::now(),
            ],
            [
                'name' => 'event3',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => EventConst::MAX_PEOPLE_OPTION[2],
                'start_date' => $this->today->addDays(2)->addHours(10),
                'end_date' => $this->today->addDays(2)->addHours(11),
                'is_visible' => EventConst::STATUS_DISPLAY,
                'created_at' => CarbonImmutable::now(),
            ],
            [
                'name' => 'event4',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => EventConst::MAX_PEOPLE_OPTION[3],
                'start_date' => $this->today->addDays(3)->addHours(11),
                'end_date' => $this->today->addDays(3)->addHours(14),
                'is_visible' => EventConst::STATUS_DISPLAY,
                'created_at' => CarbonImmutable::now(),
            ],
            [
                'name' => 'event5',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => EventConst::MAX_PEOPLE_OPTION[1],
                'start_date' => $this->today->addDays(4)->addHours(10),
                'end_date' => $this->today->addDays(4)->addHours(13),
                'is_visible' => EventConst::STATUS_DISPLAY,
                'created_at' => CarbonImmutable::now(),
            ],
            [
                'name' => 'event6',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => EventConst::MAX_PEOPLE_OPTION[3],
                'start_date' => $this->today->addDays(6)->addHours(15),
                'end_date' => $this->today->addDays(6)->addHours(18),
                'is_visible' => EventConst::STATUS_DISPLAY,
                'created_at' => CarbonImmutable::now(),
            ],
            [
                'name' => 'event7',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => EventConst::MAX_PEOPLE_OPTION[3],
                'start_date' => $this->today->addDays(8)->addHours(9),
                'end_date' => $this->today->addDays(8)->addHours(13),
                'is_visible' => EventConst::STATUS_DISPLAY,
                'created_at' => CarbonImmutable::now(),
            ],
        ]);
    }
}
