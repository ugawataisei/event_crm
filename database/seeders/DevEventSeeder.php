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
                'start_date' => '2023-01-20 00:00:00',
                'end_date' => '2023-01-20 12:00:00',
                'is_visible' => EventConst::STATUS_DISPLAY,
            ],
            [
                'name' => 'テストイベント2',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => 50,
                'start_date' => '2023-01-21 00:00:00',
                'end_date' => '2023-01-21 12:00:00',
                'is_visible' => EventConst::STATUS_DISPLAY,
            ],
            [
                'name' => 'テストイベント3',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => 50,
                'start_date' => '2023-01-22 00:00:00',
                'end_date' => '2023-01-22 12:00:00',
                'is_visible' => EventConst::STATUS_DISPLAY,
            ],
            [
                'name' => 'テストイベント4',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => 50,
                'start_date' => '2023-01-23 00:00:00',
                'end_date' => '2023-01-23 12:00:00',
                'is_visible' => EventConst::STATUS_DISPLAY,
            ],
            [
                'name' => 'テストイベント5',
                'information' => 'イベント情報がここに入ります。イベント情報がここに入ります。イベント情報がここに入ります。',
                'max_people' => 50,
                'start_date' => '2023-01-24 00:00:00',
                'end_date' => '2023-01-24 12:00:00',
                'is_visible' => EventConst::STATUS_DISPLAY,
            ],
        ]);
    }
}
