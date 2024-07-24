@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Update Support Ticket') }}</span>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('ticket.update', $ticket->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">{{ __('Title') }}</label>
                            <input id="title" class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title', $ticket->title) }}" autofocus placeholder="Enter title">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">{{ __('Description') }}</label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="3" placeholder="Add description">{{ old('description', $ticket->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Attachment -->
                        <div class="mb-3">
                            @if ($ticket->attachment)
                                <a href="{{ asset('storage/' . $ticket->attachment) }}" class="text-primary" target="_blank">See Attachment</a>
                            @endif
                            <label for="attachment" class="form-label">{{ __('Attachment (if any)') }}</label>
                            <input id="attachment" class="form-control @error('attachment') is-invalid @enderror" type="file" name="attachment">
                            @error('attachment')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
