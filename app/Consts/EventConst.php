<?php

namespace App\Consts;

use Carbon\Carbon;

class EventConst
{
    public const STATUS_HIDDEN = 0;
    public const STATUS_DISPLAY = 1;

    public const MB_STATUS_HIDDEN = '非表示';
    public const MB_STATUS_DISPLAY = '表示';

    public const EVENT_STATUS = [
        self::STATUS_HIDDEN => self::MB_STATUS_HIDDEN,
        self::STATUS_DISPLAY => self::MB_STATUS_DISPLAY,
    ];

    public const MAX_PEOPLE_OPTION = [10, 20, 30, 40, 50];

    public const EVENT_TIME_OPTION = [
        '10:00',
        '10:30',
        '11:00',
        '11:30',
        '12:00',
        '12:30',
        '13:00',
        '13:30',
        '14:00',
        '14:30',
        '14:00',
        '14:30',
        '15:00',
        '15:30',
        '16:00',
        '16:30',
        '17:00',
        '17:30',
        '18:00',
        '18:30',
        '19:00',
        '19:30',
        '20:00',
    ];

    public const MAX_PEOPLE_RESERVATION = 10;

    public const AMOUNT_DAYS_IN_ONE_WEEK = 7;
}
