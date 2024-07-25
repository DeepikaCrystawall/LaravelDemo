@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Tickets</h1>

    <div class="card">
        <div class="card-body">
            @session('success')
            <div class="alert alert-success">{{session('success')}}</div>
            @endsession
            @if ($tickets->isEmpty())
                <p>No tickets found.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th>Action</th>
                                @if (\Auth::user()->role_id != 2)
                                <th>Change Status</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td>
                                    <a href="{{ route('ticket.show', $ticket->id) }}" class="text-decoration-none text-dark"><b>{{ $ticket->title }}</b></a></td>
                                    <td>{{ $ticket->description }}</td>
                                    <td>{{ $ticket->status }}</td>
                                    <td>{{ $ticket->user->name }}</td>
                                    <td>{{ $ticket->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                    
                                    <div class="d-flex align-items-center">
                                        <!-- <a href="{{ route('ticket.show', $ticket->id) }}" class="btn btn-primary">View</a> -->
                                        <a href="{{ route('reply',['ticketid'=> $ticket->id]) }}" class="btn btn-warning"><?php echo((\Auth::user()->role_id != 2))?'Reply':'View'?> </a>
                                    </div>

                                        </td>
                                        <td width="110px;"> 
                                        @if (\Auth::user()->role_id != 2)
                                            <select class="form-control status-dropdown"
                                                data-ticket-id="{{ $ticket->id }}"
                                                data-toggle-url="{{ route('ticket.toggleStatus', $ticket->id) }}">
                                                
                                            <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                            <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                            <option value="rejected" {{ $ticket->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                        @endif
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $tickets->links() }}
                <!-- Pagination links -->
            @endif
        </div>
    </div>
</div>



@endsection

@section('scripts')

<!-- AJAX Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('.status-dropdown').change(function () {
            var ticketId = $(this).data('ticket-id');
            var toggleUrl = $(this).data('toggle-url');
            var newStatus = $(this).val();

            // Perform AJAX request
            $.ajax({
                url: toggleUrl,
                type: 'post', // Assuming your route uses PUT method
                data: {
                    _token: '{{ csrf_token() }}',
                    status: newStatus
                },
                success: function (response) {
                    // Optional: Show success message or update UI as needed
                    $('#ticket-' + ticketId + ' .status-dropdown').val(response.status);
                    showAlert('success', 'Status updated successfully.');

                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Failed to update status. Please try again.');
                }
            });
        });



        function showAlert(type, message) {
            // Create alert element
            var alert = $('<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
                            '<strong>' + message + '</strong>' +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>');

            // Append to body and fade out after 3 seconds
            //$('body').append(alert);
            $('.table').before(alert);

            setTimeout(function () {
                alert.fadeOut();
            }, 3000);
        }
    });
</script>

@endsection
