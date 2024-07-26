@extends('layouts.master')

@section('content')
<div class="container">   
    <div class="card">
        <div class="card-body">
            <div class="row show-msg">
                <h3>Ticket Details</h3>
                <div class="container">
                    <ul>
                        <li>Title : {{$ticket->title}}</li>
                        <li>Description : {{$ticket->description}}</li>
                        <li>Created Date : {{$ticket->created_at}}</li>
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
                    <div class="d-flex justify-content-between">
                        <div>
                            <ul class="ul-status">
                                <li>
                                    <a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-warning me-2">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('ticket.destroy', $ticket->id) }}" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this ticket?');">
                                    @method('delete')
                                    @csrf
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </li>
                                @if (\Auth::user()->role_id != 2)
                                <li class="sts-li ml-4">
                                    <p class="pt-2">Status :</p>
                                    <select class="form-control status-dropdown ml-3"
                                                data-ticket-id="{{ $ticket->id }}"
                                                data-toggle-url="{{ route('ticket.toggleStatus', $ticket->id) }}">
                                                
                                            <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                            <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                            <option value="rejected" {{ $ticket->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                </li>
                                @else
                                <span class="badge bg-success pt-3 ml-2 ">Status: {{ $ticket->status }}</span>
                                @endif 
                            </ul>
                        </div>
                </div>
            </div>
                        
        </div>
    </div>
    <?php /*?>
    <div class="card mt-2">
        <div class="card-body">
<div class="row  mb-4">
            @if(!$replies->isEmpty())
                <h2>Replies</h2>
                <div class="container">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Reply</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($replies as $reply)
                            <tr>
                                <td>{{ $reply->body}}</td>
                                <td>{{ $reply->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>              
                </div>
            @else
               <p>No Replies Yet</p>
            @endif    
        </div>
</div>
</div>
<?php */?>
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
            $('.show-msg').before(alert);

            setTimeout(function () {
                alert.fadeOut();
            }, 3000);
        }
    });
</script>

@endsection

