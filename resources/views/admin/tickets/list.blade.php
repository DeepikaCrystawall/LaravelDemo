@extends('layouts.master')
@section('content')
<div class="container">
    <h1>Tickets</h1>
    <a href="{{ route('ticket.create')}}" class="btn btn-primary mb-4">Create +</a>  
    <div class="card">
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

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
                                        <a href="{{ route('ticket.show', $ticket->id) }}" class="text-decoration-none text-dark"><b>{{ $ticket->title }}</b></a>
                                    </td>
                                    <td>{{ $ticket->description }}</td>
                                    <td>{{ $ticket->status }}</td>
                                    <td>{{ $ticket->user->name }}</td>
                                    <td>{{ $ticket->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('reply', ['ticketid' => $ticket->id]) }}" class="btn btn-warning">
                                                {{ \Auth::user()->role_id != 2 ? 'Reply' : 'View' }}
                                            </a>
                                        </div>
                                    </td>
                                    @if (\Auth::user()->role_id != 2)
                                    <td width="110px;">
                                        <select class="form-control status-dropdown"
                                            data-ticket-id="{{ $ticket->id }}"
                                            data-toggle-url="{{ route('ticket.toggleStatus', $ticket->id) }}">
                                            <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                            <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                            <option value="rejected" {{ $ticket->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $tickets->links() }}
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.status-dropdown').change(function () {
            var ticketId = $(this).data('ticket-id');
            var toggleUrl = $(this).data('toggle-url');
            var newStatus = $(this).val();

            $.ajax({
                url: toggleUrl,
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: newStatus
                },
                success: function (response) {
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
            var alert = $('<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
                            '<strong>' + message + '</strong>' +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>');

            $('.table').before(alert);

            setTimeout(function () {
                alert.fadeOut();
            }, 3000);
        }
    });
</script>
@endsection
