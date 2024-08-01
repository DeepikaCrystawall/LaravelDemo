<div class="card shadow-sm border-light">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{ __('Enquiry') }}</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('ticket.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" required>
            </div>
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" required></textarea>
            </div>
            <!-- Hidden input for product_id -->
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="form-group mb-3">
                <label for="attachment">Attachment</label>
                <input type="file" name="attachment" class="form-control" id="attachment">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
