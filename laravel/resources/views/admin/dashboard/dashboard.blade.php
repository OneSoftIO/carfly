@extends('admin.general')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Rezervacijos</h5>
                </div>
                <div class="ibox-content">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">

        $.ajax({
            type: "POST",
            url: 'administruoti/calendar/data',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                setBookingReservations(data);
            }
        });

        function setBookingReservations(data) {
            var list = data.data;
            var myEvents = [];

            list.forEach(function (element) {
                if (element.vehicles !== null) {
                    myEvents.push({
                        title: element.vehicles.name,
                        start: element.from,
                        end: element.until
                    });
                }
            });

            $('#calendar').fullCalendar({
                weekends: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                locale: 'lt',
                eventClick: function (event) {
//                    if (event.url) {
//                        window.open(event.url);
//                        return false;
//                    }
                },

                timeFormat: 'H(:mm)',
                editable: false,
                eventLimit: true,
                navLinks: false,
                events: myEvents
            });
        }
    </script>
@endsection