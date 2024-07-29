@extends('layouts.master')

@section('content')
@php
    use Illuminate\Support\Str;
@endphp
<div class="container mt-5">
    <div class="card shadow-sm border-light">
        <div class="card-body">
            <div class="row show-msg">
                <h3 class="mb-4">Ticket Details</h3>
                <div class="container">
                    <ul class="list-unstyled">
                        <li><strong>Title:</strong> {{ $ticket->title }}</li>
                        <li><strong>Description:</strong> {{ Str::limit($ticket->description, 200) }}</li>
                        <li><strong>Created Date:</strong> {{ $ticket->created_at }}
                            <i class="bi bi-eye"></i> <!-- View Icon -->
                        </li>
                        @if ($ticket->attachment)
                        <li>
                            <div class="mb-4">
                                <a href="{{ '/storage/' . $ticket->attachment }}" class="btn btn-outline-primary" target="_blank">
                                    <i class="bi bi-paperclip"></i> View Attachment
                                </a>
                            </div>
                        </li>
                        @endif   
                    </ul>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-warning me-2">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('ticket.destroy', $ticket->id) }}" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this ticket?');">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                        @if (\Auth::user()->role_id != 2)
                        <div class="d-flex align-items-center">
                            <p class="mb-0 me-2">Status:</p>
                            <select class="form-control status-dropdown" data-ticket-id="{{ $ticket->id }}" data-toggle-url="{{ route('ticket.toggleStatus', $ticket->id) }}">
                                <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="rejected" {{ $ticket->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        @else
                        <span class="badge bg-success">Status: {{ $ticket->status }}</span>
                        @endif
                    </div>
                </div>
            </div>
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
                type: 'post', // Assuming your route uses POST method
                data: {
                    _token: '{{ csrf_token() }}',
                    status: newStatus
                },
                success: function (response) {
                    // Optional: Show success message or update UI as needed
                    showAlert('success', 'Status updated successfully.');
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    showAlert('danger', 'Failed to update status. Please try again.');
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
            $('.show-msg').before(alert);

            setTimeout(function () {
                alert.fadeOut(function() {
                    $(this).remove();
                });
            }, 3000);
        }
    });
</script>
@endsection
