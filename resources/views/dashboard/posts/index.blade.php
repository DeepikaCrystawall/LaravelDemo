@extends('layouts.master')

@section('content')
<div class="container">
    <h1>@section('title', 'Post List | Luis N Vaya') Posts</h1>
    <a href="{{ route('posts.create')}}" class="btn btn-success mb-4">Create +</a>  
    <div class="card">
        <div class="card-body">
            @session('success')
            <div class="alert alert-success alert-dismissible fade show">{{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endsession
            @if ($posts->isEmpty())
                <p>No Posts found.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>SL No</th>
                            <th>Title</th>
                            <th>Body</th>
                            <th>Published</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $pkey =>$post)
                                <tr>
                                    <td>{{$pkey +1}}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{!! Illuminate\Support\Str::limit($post->body, 50) !!}</td>
                                    <td>{{ $post->published}}</td>                                   
                                    <td>
                                       
                                        @can('blog-list')
                                            @php
                                                $label = $post->published == 'Yes' ? 'Draft' : 'Publish';
                                            @endphp
                                            <a href="{{ url('/posts/'.$post->id.'/publish') }}" class="btn btn-warning btn-sm"> {{ $label }}</a>
                                        @endcan
                                        <a href="{{ url('/blog/'.$post->id) }}" class="btn btn-success btn-sm">
                                            <i class="fa fa-eye"></i> 
                                        </a>
                                        <a href="{{ url('/posts/'.$post->id.'/edit') }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-edit"></i> 
                                        </a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this ticket?');">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i> <!-- Delete Icon -->
                                                </button>
                                            </form>
                                        <!-- <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="{{ $post->id }}">
                                            <i class="fa fa-trash"></i> 
                                        </button> -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $posts->links() }}
                <!-- Pagination links -->
            @endif
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="" id="deleteForm">
            @csrf
            @method('delete')           
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this post?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- <script>
    $('#deleteModal').on('show.bs.modal', function (event) { alert('ok');
        var button = $(event.relatedTarget);
        var postId = button.data('id');
        alert(postId);
        var action = "{{ route('posts.destroy', ':id') }}".replace(':id', postId);

        var form = $('#deleteForm');
        form.attr('action', action);
    });
</script> -->

<style>
    .action-buttons {
        display: flex;
        gap: 5px;
    }
    .action-buttons .btn {
        flex: 1;
        min-width: 75px;
    }
</style>

@endsection
