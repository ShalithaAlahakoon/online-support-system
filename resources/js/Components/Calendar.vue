<template>
    <div
        class="widget-calendar border-black/12.5 shadow-soft-xl dark:bg-gray-950 dark:shadow-soft-dark-xl relative flex h-full min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
        <div class="p-4 pb-0 rounded-t-2xl">
            <h6 class="mb-0 dark:text-white">{{ title }}</h6>
            <div class="flex">
                <div class="mb-0 font-semibold leading-normal widget-calendar-day text-sm">{{ day }}</div>
                <span>,&nbsp;</span>
                <div class="mb-1 font-semibold leading-normal widget-calendar-year text-sm">{{ year }}</div>
            </div>
        </div>
        <div class="flex-auto p-4">
            <div :id="id" data-toggle="widget-calendar" class="fc fc-media-screen fc-direction-ltr fc-theme-standard">
                <div class="fc-view-harness fc-view-harness-passive">
                    <div class="fc-daygrid fc-dayGridMonth-view fc-view">
                        <table class="fc-scrollgrid ">
                            <thead>
                            <tr class="fc-scrollgrid-section fc-scrollgrid-section-header ">
                                <td>
                                    <div class="fc-scroller-harness">
                                        <div class="fc-scroller" style="overflow: visible;">
                                            <table class="fc-col-header " style="width: 590px;">
                                                <colgroup></colgroup>
                                                <tbody>
                                                <tr>
                                                    <th class="fc-col-header-cell fc-day fc-day-sun">
                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                            class="fc-col-header-cell-cushion ">Sun</a></div>
                                                    </th>
                                                    <th class="fc-col-header-cell fc-day fc-day-mon">
                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                            class="fc-col-header-cell-cushion ">Mon</a></div>
                                                    </th>
                                                    <th class="fc-col-header-cell fc-day fc-day-tue">
                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                            class="fc-col-header-cell-cushion ">Tue</a></div>
                                                    </th>
                                                    <th class="fc-col-header-cell fc-day fc-day-wed">
                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                            class="fc-col-header-cell-cushion ">Wed</a></div>
                                                    </th>
                                                    <th class="fc-col-header-cell fc-day fc-day-thu">
                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                            class="fc-col-header-cell-cushion ">Thu</a></div>
                                                    </th>
                                                    <th class="fc-col-header-cell fc-day fc-day-fri">
                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                            class="fc-col-header-cell-cushion ">Fri</a></div>
                                                    </th>
                                                    <th class="fc-col-header-cell fc-day fc-day-sat">
                                                        <div class="fc-scrollgrid-sync-inner"><a
                                                            class="fc-col-header-cell-cushion ">Sat</a></div>
                                                    </th>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="fc-scrollgrid-section fc-scrollgrid-section-body ">
                                <td>
                                    <div class="fc-scroller-harness">
                                        <div class="fc-scroller" style="overflow: visible;">
                                            <div
                                                class="fc-daygrid-body fc-daygrid-body-unbalanced fc-daygrid-body-natural"
                                                style="width: 590px;">
                                                <table class="fc-scrollgrid-sync-table" style="width: 590px;">
                                                    <colgroup></colgroup>
                                                    <tbody>
                                                    <tr>
                                                        <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past fc-day-other"
                                                            data-date="2020-11-29">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">29</a></div>
                                                                <div class="fc-daygrid-day-events">
                                                                    <div class="fc-daygrid-event-harness"><a
                                                                        class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past bg-gradient-to-tl from-green-600 to-lime-400">
                                                                        <div class="fc-event-main">
                                                                            <div class="fc-event-main-frame">
                                                                                <div class="fc-event-title-container">
                                                                                    <div
                                                                                        class="fc-event-title fc-sticky">
                                                                                        All day conference
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="fc-event-resizer fc-event-resizer-end"></div>
                                                                    </a></div>
                                                                </div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past fc-day-other"
                                                            data-date="2020-11-30">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">30</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past"
                                                            data-date="2020-12-01">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">1</a></div>
                                                                <div class="fc-daygrid-day-events">
                                                                    <div class="fc-daygrid-event-harness"><a
                                                                        class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past bg-gradient-to-tl from-blue-600 to-cyan-400">
                                                                        <div class="fc-event-main">
                                                                            <div class="fc-event-main-frame">
                                                                                <div class="fc-event-title-container">
                                                                                    <div
                                                                                        class="fc-event-title fc-sticky">
                                                                                        Meeting with Mary
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="fc-event-resizer fc-event-resizer-end"></div>
                                                                    </a></div>
                                                                </div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past"
                                                            data-date="2020-12-02">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">2</a></div>
                                                                <div class="fc-daygrid-day-events">
                                                                    <div class="fc-daygrid-event-harness"><a
                                                                        class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past bg-gradient-to-tl from-red-500 to-yellow-400">
                                                                        <div class="fc-event-main">
                                                                            <div class="fc-event-main-frame">
                                                                                <div class="fc-event-title-container">
                                                                                    <div
                                                                                        class="fc-event-title fc-sticky">
                                                                                        Cyber Week
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="fc-event-resizer fc-event-resizer-end"></div>
                                                                    </a></div>
                                                                </div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past"
                                                            data-date="2020-12-03">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">3</a></div>
                                                                <div class="fc-daygrid-day-events">
                                                                    <div class="fc-daygrid-event-harness"><a
                                                                        class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past bg-gradient-to-tl from-red-600 to-rose-400">
                                                                        <div class="fc-event-main">
                                                                            <div class="fc-event-main-frame">
                                                                                <div class="fc-event-title-container">
                                                                                    <div
                                                                                        class="fc-event-title fc-sticky">
                                                                                        Winter Hackaton
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="fc-event-resizer fc-event-resizer-end"></div>
                                                                    </a></div>
                                                                </div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past"
                                                            data-date="2020-12-04">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">4</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past"
                                                            data-date="2020-12-05">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">5</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past"
                                                            data-date="2020-12-06">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">6</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past"
                                                            data-date="2020-12-07">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">7</a></div>
                                                                <div class="fc-daygrid-day-events"
                                                                     style="padding-bottom: 29.15px;">
                                                                    <div
                                                                        class="fc-daygrid-event-harness fc-daygrid-event-harness-abs"
                                                                        style="right: -84.275px;"><a
                                                                        class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past bg-gradient-to-tl from-red-500 to-yellow-400">
                                                                        <div class="fc-event-main">
                                                                            <div class="fc-event-main-frame">
                                                                                <div class="fc-event-title-container">
                                                                                    <div
                                                                                        class="fc-event-title fc-sticky">
                                                                                        Digital event
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="fc-event-resizer fc-event-resizer-end"></div>
                                                                    </a></div>
                                                                </div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past"
                                                            data-date="2020-12-08">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">8</a></div>
                                                                <div class="fc-daygrid-day-events"
                                                                     style="padding-bottom: 29.15px;"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past"
                                                            data-date="2020-12-09">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">9</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past"
                                                            data-date="2020-12-10">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">10</a></div>
                                                                <div class="fc-daygrid-day-events">
                                                                    <div class="fc-daygrid-event-harness"><a
                                                                        class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past bg-gradient-to-tl from-purple-700 to-pink-500">
                                                                        <div class="fc-event-main">
                                                                            <div class="fc-event-main-frame">
                                                                                <div class="fc-event-title-container">
                                                                                    <div
                                                                                        class="fc-event-title fc-sticky">
                                                                                        Marketing event
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="fc-event-resizer fc-event-resizer-end"></div>
                                                                    </a></div>
                                                                </div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past"
                                                            data-date="2020-12-11">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">11</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past"
                                                            data-date="2020-12-12">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">12</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past"
                                                            data-date="2020-12-13">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">13</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past"
                                                            data-date="2020-12-14">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">14</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past"
                                                            data-date="2020-12-15">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">15</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past"
                                                            data-date="2020-12-16">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">16</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past"
                                                            data-date="2020-12-17">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">17</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past"
                                                            data-date="2020-12-18">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">18</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past"
                                                            data-date="2020-12-19">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">19</a></div>
                                                                <div class="fc-daygrid-day-events">
                                                                    <div class="fc-daygrid-event-harness"><a
                                                                        class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past bg-gradient-to-tl from-red-600 to-rose-400">
                                                                        <div class="fc-event-main">
                                                                            <div class="fc-event-main-frame">
                                                                                <div class="fc-event-title-container">
                                                                                    <div
                                                                                        class="fc-event-title fc-sticky">
                                                                                        Dinner with Family
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="fc-event-resizer fc-event-resizer-end"></div>
                                                                    </a></div>
                                                                </div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past"
                                                            data-date="2020-12-20">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">20</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past"
                                                            data-date="2020-12-21">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">21</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past"
                                                            data-date="2020-12-22">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">22</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past"
                                                            data-date="2020-12-23">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">23</a></div>
                                                                <div class="fc-daygrid-day-events">
                                                                    <div class="fc-daygrid-event-harness"><a
                                                                        class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past bg-gradient-to-tl from-blue-600 to-cyan-400">
                                                                        <div class="fc-event-main">
                                                                            <div class="fc-event-main-frame">
                                                                                <div class="fc-event-title-container">
                                                                                    <div
                                                                                        class="fc-event-title fc-sticky">
                                                                                        Black Friday
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="fc-event-resizer fc-event-resizer-end"></div>
                                                                    </a></div>
                                                                </div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past"
                                                            data-date="2020-12-24">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">24</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past"
                                                            data-date="2020-12-25">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">25</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past"
                                                            data-date="2020-12-26">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">26</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past"
                                                            data-date="2020-12-27">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">27</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past"
                                                            data-date="2020-12-28">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">28</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past"
                                                            data-date="2020-12-29">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">29</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past"
                                                            data-date="2020-12-30">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">30</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past"
                                                            data-date="2020-12-31">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">31</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past fc-day-other"
                                                            data-date="2021-01-01">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">1</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past fc-day-other"
                                                            data-date="2021-01-02">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">2</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past fc-day-other"
                                                            data-date="2021-01-03">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">3</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past fc-day-other"
                                                            data-date="2021-01-04">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">4</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past fc-day-other"
                                                            data-date="2021-01-05">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">5</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past fc-day-other"
                                                            data-date="2021-01-06">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">6</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past fc-day-other"
                                                            data-date="2021-01-07">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">7</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past fc-day-other"
                                                            data-date="2021-01-08">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">8</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                        <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past fc-day-other"
                                                            data-date="2021-01-09">
                                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                <div class="fc-daygrid-day-top"><a
                                                                    class="fc-daygrid-day-number">9</a></div>
                                                                <div class="fc-daygrid-day-events"></div>
                                                                <div class="fc-daygrid-day-bg"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script setup>
import {Calendar} from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import {onMounted} from "vue";

let calendar;
const beforeUnmount = () => {
    if (calendar) {
        calendar.destroy();
    }
}

defineProps({
    id: {
        type: String,
        default: "widget-calendar",
    },
    title: {
        type: String,
        default: "Calendar",
    },
    day: {
        type: String,
        default: "Tuesday",
    },
    year: {
        type: String,
        default: "2022",
    },
    initialView: {
        type: String,
        default: "dayGridMonth",
    },
    initialDate: {
        type: String,
        default: "2022-02-24",
    },
    events: {
        type: Array,
        default: () => {
            [
                {
                    title: "Call with Dave",
                    start: "2020-11-18",
                    end: "2020-11-18",
                    class: "bg-gradient-danger",
                },

                {
                    title: "Lunch meeting",
                    start: "2020-11-21",
                    end: "2020-11-22",
                    class: "bg-gradient-warning",
                },

                {
                    title: "All day conference",
                    start: "2020-11-29",
                    end: "2020-11-29",
                    class: "bg-gradient-success",
                },

                {
                    title: "Meeting with Mary",
                    start: "2020-12-01",
                    end: "2020-12-01",
                    class: "bg-gradient-info",
                },

                {
                    title: "Winter Hackaton",
                    start: "2020-12-03",
                    end: "2020-12-03",
                    class: "bg-gradient-danger",
                },

                {
                    title: "Digital event",
                    start: "2020-12-07",
                    end: "2020-12-09",
                    class: "bg-gradient-warning",
                },

                {
                    title: "Marketing event",
                    start: "2020-12-10",
                    end: "2020-12-10",
                    class: "bg-gradient-primary",
                },

                {
                    title: "Dinner with Family",
                    start: "2020-12-19",
                    end: "2020-12-19",
                    class: "bg-gradient-danger",
                },

                {
                    title: "Black Friday",
                    start: "2020-12-23",
                    end: "2020-12-23",
                    class: "bg-gradient-info",
                },

                {
                    title: "Cyber Week",
                    start: "2020-12-02",
                    end: "2020-12-02",
                    class: "bg-gradient-warning",
                },
            ];
        },
    },
    selectable: {
        type: Boolean,
        default: true,
    },
    editable: {
        type: Boolean,
        default: true,
    },
})

onMounted((calendar) => {
    calendar = new Calendar(document.getElementById(this.id), {
        contentHeight: "auto",
        plugins: [dayGridPlugin],
        initialView: this.initialView,
        selectable: this.selectable,
        editable: this.editable,
        initialDate: this.initialDate,
        events: this.events,
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth",
        },
        views: {
            month: {
                titleFormat: {
                    month: "long",
                    year: "numeric",
                },
            },
            agendaWeek: {
                titleFormat: {
                    month: "long",
                    year: "numeric",
                    day: "numeric",
                },
            },
            agendaDay: {
                titleFormat: {
                    month: "short",
                    year: "numeric",
                    day: "numeric",
                },
            },
        },
    });

    calendar.render();
})
</script>
