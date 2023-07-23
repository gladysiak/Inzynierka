@extends('layout')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/home-style.css">
    <link rel="stylesheet" href="{{ asset('css/home-style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
@endsection

@section('content')
<div class="modal fade" id="eventsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tytuł wydarzenia</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="title">
                <span id="titleError" class="text-danger"></span>
                <div class="form-group">
                    <label for="group">Grupa:</label>
                    <select class="form-control" id="group" name="group">
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                <button type="button" id="saveTit" class="btn btn-primary">Zapisz zmiany</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <h3>Kalendarz Spotkań</h3>
    <div id="calendar"></div>
</div>

<script>
    $(document).ready(function() {
        var selectedStartDate;
        var selectedEndDate;

        $('#calendar').fullCalendar({
            monthNames: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Pażdziernik', 'Listopad', 'Grudzień'],
            monthNamesShort: ['Sty', 'Lut', 'Mrz', 'Kw', 'Maj', 'Cz', 'Lip', 'Sier', 'Wrz', 'Paż', 'Lis', 'Gr'],
            dayNames: ['Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela'],
            dayNamesShort: ['Pon', 'Wt', 'Śr', 'Czw', 'Pt', 'Sob', 'Nied'],
            header: {
                left: 'prev, next today',
                center: 'title',
                right: '',
            },
            eventBackgroundColor: '#9c45ff',
            eventBorderColor: '#9c45ff',
            eventTextColor: 'white',
            selectable: true,
            selectHelper: true,
            selectAllow: function(event)
            {
                return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false), 'day');
            },
            select: function(start, end, allDays) {
                selectedStartDate = start;
                selectedEndDate = end;
                $('#title').val(''); // Wyczyszczenie zawartości pola tytułu
                $('#eventsModal').modal('toggle');
            },
            events: function(start, end, timezone, success) {
                $.ajax({
                    url: "{{ route('fullcalendar.events') }}",
                    type: "GET",
                    dataType: 'json',
                    data: {
                        group: $('#group').val(), // Dodaj zalogowanego użytkownika
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        var events = [];
                        response.forEach(function(event) {
                            events.push({
                                id: event.id,
                                title: event.title,
                                start: event.start,
                                end: event.end
                            });
                        });
                        success(events);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            },
            eventClick: function(calEvent, jsEvent, view) {
                if (confirm('Czy na pewno chcesz usunąć to wydarzenie?')) {
                    $.ajax({
                        url: "{{ route('fullcalendar.destroy', ':id') }}".replace(':id', calEvent.id),
                        type: "DELETE",
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#calendar').fullCalendar('removeEvents', calEvent.id);
                            alert('Wydarzenie zostało usunięte.');
                        },
                        error: function(error) {
                            alert('Wystąpił błąd podczas usuwania wydarzenia.');
                        }
                    });
                }
            }
        });

        $('#saveTit').click(function() {
            var title = $('#title').val();
            var start = moment(selectedStartDate).format('YYYY-MM-DD');
            var end = moment(selectedEndDate).format('YYYY-MM-DD');
            var group = $('#group').val(); // Pobranie wartości wybranej grupy

            $.ajax({
                url: "{{ route('fullcalendar.store') }}",
                type: "POST",
                dataType: 'json',
                data: { title: title, start: start, end: end, group: group }, // Przekazanie grupy jako parametru
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Zapisz identyfikator grupy w sesji użytkownika
                    var selectedGroupId = group;
                    $.ajax({
                        url: "{{ route('fullcalendar.saveGroupId') }}",
                        type: "POST",
                        dataType: 'json',
                        data: { group: selectedGroupId },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // Po zapisaniu identyfikatora grupy w sesji, możesz odświeżyć stronę, jeśli chcesz
                            location.reload();
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                },
                error: function(error) {
                    if (error.responseJSON && error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                }
            });
        });

    });
</script>
@endsection
