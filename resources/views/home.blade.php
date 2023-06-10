@extends('layouts.app_layout')
<link rel="stylesheet" href="{{ asset('css/pages/home.css') }}">
@section('content')
    <div class="row">
        <div class="col-9 home_left_div p-4">
            <div class="row">
                <h2 class="home_title">
                    Bienvenue {{ Auth::user()->last_name }} {{ Auth::user()->first_name }} ! <i class="fa-thin fa-robot"></i>
                </h2>
            </div>
            <div class="row">
                <div class="col-7 home_main_picture p-0 m-3">
                    <img src="{{ asset('images/assets/intraheader.png') }}" alt="">
                </div>
            </div>
            <div class="row mt-5">
                <h3 class="home_title">Dernières publications</h3>
            </div>
            <div class="row">
                <div class="col-5 home_post m-3"></div>
                <div class="col-5 home_post m-3"></div>
                <div class="col-5 home_post m-3"></div>
                <div class="col-5 home_post m-3"></div>
                <div class="col-5 home_post m-3"></div>
                <div class="col-5 home_post m-3"></div>
            </div>
        </div>
        <div class="col-3">
            <div class="row mt-5">
                <h4 class="home_title">Recherche rapide</h4>
                <form action="" method="GET" class="mt-3">
                    <input type="text" name="query" placeholder="Rechercher..." class="search_bar">
                    <button type="submit" class="search_bar_button">Rechercher</button>
                </form>
            </div>
            <div class="row mt-5 ">
                <div class="col-10 mb-3">
                    <h4 class="home_title">Amis</h4>
                    <div class="d-flex align-items-center mt-3">
                        <img src="{{ asset('images/users/profile/default.jpg') }}" alt="" class="profile-picture">
                        <div class="ms-2 friends_name">Stefan Toader <i class="fa-solid fa-circle"></i></div>
                        <div class="ms-auto friends_icons">
                            <i class="fa-solid fa-user"></i>
                            <i class="fa-solid fa-phone-alt"></i>
                            <i class="fa-solid fa-message"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-3">
                        <img src="{{ asset('images/users/profile/default.jpg') }}" alt="" class="profile-picture">
                        <div class="ms-2 friends_name">Eva Maudoux <i class="fa-solid fa-circle"></i></div>
                        <div class="ms-auto friends_icons">
                            <i class="fa-solid fa-user"></i>
                            <i class="fa-solid fa-phone-alt"></i>
                            <i class="fa-solid fa-message"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-3">
                        <img src="{{ asset('images/users/profile/default.jpg') }}" alt="" class="profile-picture">
                        <div class="ms-2 friends_name">Pierre Hardy <i class="fa-solid fa-circle"></i></div>
                        <div class="ms-auto friends_icons">
                            <i class="fa-solid fa-user"></i>
                            <i class="fa-solid fa-phone-alt"></i>
                            <i class="fa-solid fa-message"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-3">
                        <img src="{{ asset('images/users/profile/default.jpg') }}" alt="" class="profile-picture">
                        <div class="ms-2 friends_name">Sylvain Piefort <i class="fa-solid fa-circle"></i></div>
                        <div class="ms-auto friends_icons">
                            <i class="fa-solid fa-user"></i>
                            <i class="fa-solid fa-phone-alt"></i>
                            <i class="fa-solid fa-message"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-10">
                    <h4 class="home_title">Calendrier</h4>
                    <div class="calendar"></div>
                </div>
            </div>
        </div>
    </div>





















    <script>
        //check the console for date click event
        //Fixed day highlight
        //Added previous month and next month view

        function CalendarControl() {
            const calendar = new Date();
            const calendarControl = {
                localDate: new Date(),
                prevMonthLastDate: null,
                calWeekDays: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                calMonthName: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec"
                ],
                daysInMonth: function (month, year) {
                    return new Date(year, month, 0).getDate();
                },
                firstDay: function () {
                    return new Date(calendar.getFullYear(), calendar.getMonth(), 1);
                },
                lastDay: function () {
                    return new Date(calendar.getFullYear(), calendar.getMonth() + 1, 0);
                },
                firstDayNumber: function () {
                    return calendarControl.firstDay().getDay() + 1;
                },
                lastDayNumber: function () {
                    return calendarControl.lastDay().getDay() + 1;
                },
                getPreviousMonthLastDate: function () {
                    let lastDate = new Date(
                        calendar.getFullYear(),
                        calendar.getMonth(),
                        0
                    ).getDate();
                    return lastDate;
                },
                navigateToPreviousMonth: function () {
                    calendar.setMonth(calendar.getMonth() - 1);
                    calendarControl.attachEventsOnNextPrev();
                },
                navigateToNextMonth: function () {
                    calendar.setMonth(calendar.getMonth() + 1);
                    calendarControl.attachEventsOnNextPrev();
                },
                navigateToCurrentMonth: function () {
                    let currentMonth = calendarControl.localDate.getMonth();
                    let currentYear = calendarControl.localDate.getFullYear();
                    calendar.setMonth(currentMonth);
                    calendar.setYear(currentYear);
                    calendarControl.attachEventsOnNextPrev();
                },
                displayYear: function () {
                    let yearLabel = document.querySelector(".calendar .calendar-year-label");
                    yearLabel.innerHTML = calendar.getFullYear();
                },
                displayMonth: function () {
                    let monthLabel = document.querySelector(
                        ".calendar .calendar-month-label"
                    );
                    monthLabel.innerHTML = calendarControl.calMonthName[calendar.getMonth()];
                },
                selectDate: function (e) {
                    console.log(
                        `${e.target.textContent} ${
                            calendarControl.calMonthName[calendar.getMonth()]
                        } ${calendar.getFullYear()}`
                    );
                },
                plotSelectors: function () {
                    document.querySelector(
                        ".calendar"
                    ).innerHTML += `<div class="calendar-inner"><div class="calendar-controls">
          <div class="calendar-prev"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 128 128"><path fill="#666" d="M88.2 3.8L35.8 56.23 28 64l7.8 7.78 52.4 52.4 9.78-7.76L45.58 64l52.4-52.4z"/></svg></a></div>
          <div class="calendar-year-month">
          <div class="calendar-month-label"></div>
          <div>-</div>
          <div class="calendar-year-label"></div>
          </div>
          <div class="calendar-next"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 128 128"><path fill="#666" d="M38.8 124.2l52.4-52.42L99 64l-7.77-7.78-52.4-52.4-9.8 7.77L81.44 64 29 116.42z"/></svg></a></div>
          </div>
          <div class="calendar-today-date">Today:
            ${calendarControl.calWeekDays[calendarControl.localDate.getDay()]},
            ${calendarControl.localDate.getDate()},
            ${calendarControl.calMonthName[calendarControl.localDate.getMonth()]}
            ${calendarControl.localDate.getFullYear()}
          </div>
          <div class="calendar-body"></div></div>`;
                },
                plotDayNames: function () {
                    for (let i = 0; i < calendarControl.calWeekDays.length; i++) {
                        document.querySelector(
                            ".calendar .calendar-body"
                        ).innerHTML += `<div>${calendarControl.calWeekDays[i]}</div>`;
                    }
                },
                plotDates: function () {
                    document.querySelector(".calendar .calendar-body").innerHTML = "";
                    calendarControl.plotDayNames();
                    calendarControl.displayMonth();
                    calendarControl.displayYear();
                    let count = 1;
                    let prevDateCount = 0;

                    calendarControl.prevMonthLastDate = calendarControl.getPreviousMonthLastDate();
                    let prevMonthDatesArray = [];
                    let calendarDays = calendarControl.daysInMonth(
                        calendar.getMonth() + 1,
                        calendar.getFullYear()
                    );
                    // dates of current month
                    for (let i = 1; i < calendarDays; i++) {
                        if (i < calendarControl.firstDayNumber()) {
                            prevDateCount += 1;
                            document.querySelector(
                                ".calendar .calendar-body"
                            ).innerHTML += `<div class="prev-dates"></div>`;
                            prevMonthDatesArray.push(calendarControl.prevMonthLastDate--);
                        } else {
                            document.querySelector(
                                ".calendar .calendar-body"
                            ).innerHTML += `<div class="number-item" data-num=${count}><a class="dateNumber" href="#">${count++}</a></div>`;
                        }
                    }
                    //remaining dates after month dates
                    for (let j = 0; j < prevDateCount + 1; j++) {
                        document.querySelector(
                            ".calendar .calendar-body"
                        ).innerHTML += `<div class="number-item" data-num=${count}><a class="dateNumber" href="#">${count++}</a></div>`;
                    }
                    calendarControl.highlightToday();
                    calendarControl.plotPrevMonthDates(prevMonthDatesArray);
                    calendarControl.plotNextMonthDates();
                },
                attachEvents: function () {
                    let prevBtn = document.querySelector(".calendar .calendar-prev a");
                    let nextBtn = document.querySelector(".calendar .calendar-next a");
                    let todayDate = document.querySelector(".calendar .calendar-today-date");
                    let dateNumber = document.querySelectorAll(".calendar .dateNumber");
                    prevBtn.addEventListener(
                        "click",
                        calendarControl.navigateToPreviousMonth
                    );
                    nextBtn.addEventListener("click", calendarControl.navigateToNextMonth);
                    todayDate.addEventListener(
                        "click",
                        calendarControl.navigateToCurrentMonth
                    );
                    for (var i = 0; i < dateNumber.length; i++) {
                        dateNumber[i].addEventListener(
                            "click",
                            calendarControl.selectDate,
                            false
                        );
                    }
                },
                highlightToday: function () {
                    let currentMonth = calendarControl.localDate.getMonth() + 1;
                    let changedMonth = calendar.getMonth() + 1;
                    let currentYear = calendarControl.localDate.getFullYear();
                    let changedYear = calendar.getFullYear();
                    if (
                        currentYear === changedYear &&
                        currentMonth === changedMonth &&
                        document.querySelectorAll(".number-item")
                    ) {
                        document
                            .querySelectorAll(".number-item")
                            [calendar.getDate() - 1].classList.add("calendar-today");
                    }
                },
                plotPrevMonthDates: function(dates){
                    dates.reverse();
                    for(let i=0;i<dates.length;i++) {
                        if(document.querySelectorAll(".prev-dates")) {
                            document.querySelectorAll(".prev-dates")[i].textContent = dates[i];
                        }
                    }
                },
                plotNextMonthDates: function(){
                    let childElemCount = document.querySelector('.calendar-body').childElementCount;
                    //7 lines
                    if(childElemCount > 42 ) {
                        let diff = 49 - childElemCount;
                        calendarControl.loopThroughNextDays(diff);
                    }

                    //6 lines
                    if(childElemCount > 35 && childElemCount <= 42 ) {
                        let diff = 42 - childElemCount;
                        calendarControl.loopThroughNextDays(42 - childElemCount);
                    }

                },
                loopThroughNextDays: function(count) {
                    if(count > 0) {
                        for(let i=1;i<=count;i++) {
                            document.querySelector('.calendar-body').innerHTML += `<div class="next-dates">${i}</div>`;
                        }
                    }
                },
                attachEventsOnNextPrev: function () {
                    calendarControl.plotDates();
                    calendarControl.attachEvents();
                },
                init: function () {
                    calendarControl.plotSelectors();
                    calendarControl.plotDates();
                    calendarControl.attachEvents();
                }
            };
            calendarControl.init();
        }

        const calendarControl = new CalendarControl();

    </script>
@endsection
