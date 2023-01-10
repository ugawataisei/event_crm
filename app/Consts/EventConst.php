<?php

namespace App\Consts;

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
}
