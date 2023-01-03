<?php

namespace Database\Seeders;

use App\Consts\EventConst;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'name' => 'テストイベント1',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => 50,
                'start_date' => '2023-01-01 00:00:00',
                'end_date' => '2023-01-01 12:00:00',
                'is_visible' => EventConst::STATUS_DISPLAY,
            ],
            [
                'name' => 'テストイベント2',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => 50,
                'start_date' => '2023-01-05 00:00:00',
                'end_date' => '2023-01-05 12:00:00',
                'is_visible' => EventConst::STATUS_DISPLAY,
            ],
            [
                'name' => 'テストイベント3',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => 50,
                'start_date' => '2023-01-06 00:00:00',
                'end_date' => '2023-01-06 12:00:00',
                'is_visible' => EventConst::STATUS_DISPLAY,
            ],
            [
                'name' => 'テストイベント4',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => 50,
                'start_date' => '2023-01-07 00:00:00',
                'end_date' => '2023-01-07 12:00:00',
                'is_visible' => EventConst::STATUS_DISPLAY,
            ],
            [
                'name' => 'テストイベント5',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => 50,
                'start_date' => '2023-01-08 00:00:00',
                'end_date' => '2023-01-08 12:00:00',
                'is_visible' => EventConst::STATUS_DISPLAY,
            ],
        ]);
    }
}
