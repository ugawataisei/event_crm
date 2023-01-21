import flatpickr from "flatpickr";
import {Japanese} from "flatpickr/dist/l10n/ja.js"

const time_option = {
    "locale": Japanese,
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true,
    minTime: "10:00",
    maxTime: "21:00",
}

flatpickr("#event_date", {
    "locale": Japanese, // locale for this instance only
    minDate: "today", maxDate: new Date().fp_incr(30)
});

flatpickr("#calendar", {
    "locale": Japanese, // locale for this instance only
    minDate: "today", maxDate: new Date().fp_incr(30),
});

flatpickr("#start_time", time_option);

flatpickr("#end_time", time_option);
