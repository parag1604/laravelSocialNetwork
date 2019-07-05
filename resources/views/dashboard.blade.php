@extends('layouts.master')

@section('title')
Dashboard    
@endsection

@section('content')
@include('includes.message-block')
<section class="row new-post">
    <div class="col-md-6 col-md-offset-3">
        <header><h3>What do you have to say?</h3></header>
        <form action="{{route('post.create')}}" method="post">
            <div class="form-group">
                <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Type yor post here..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Post</button>
            <input type="hidden" value="{{ Session::token() }}" name="_token">
        </form>
    </div>
</section>
<section class="row posts">
    <div class="col-md-6 col-md-offset-3">
        <header>
            <h3>What other people say...</h3>
        </header>
        @foreach ($posts->all() as $post)
            @include('includes.post-block')
        @endforeach
    </div>
</section>
<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Post</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="post-body">Edit this post</label>
                        <textarea name="post_body" id="post-body" rows="5" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    var token = '{{ Session::token() }}',
        urlEdit = '{{ route("post.edit") }}',
        urlLike = '{{ route("post.like") }}';
        
</script>
@endsection