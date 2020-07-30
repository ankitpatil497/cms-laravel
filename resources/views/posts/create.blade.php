@extends('layouts.app')

@section('content')
    
<div class="card card-default">
    <div class="card-header">
        {{isset($post)?'Edit Post':'Create Post'}}
    </div>
    <div class="card-body"> 
        @include('errors.error')

        <form action="{{ isset($post) ? route('posts.update',$post->id):route('posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($post))
                @method('PUT')             
            @endif
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{isset($post)? $post->title:''}}">
            </div>
            <div class="form-group">
                <label for="title">Description</label>
                <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{isset($post)? $post->description:''}}</textarea>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <input id="content" type="hidden" name="content" value="{{isset($post)? $post->content:''}}">
                <trix-editor input="content"></trix-editor>        
            </div>
            <div class="form-group">
                <label for="published_at">published_at</label>
                <input type="text" name="published_at" id="published_at"  class="form-control" value="{{isset($post)? $post->published_at:''}}">
            </div>

            @if (isset($post))
                <div class="form-group">
                    <img src="{{asset(URL::to('/storage/' .$post->image))}}" style="width:100px" alt="">
                </div>
            @endif
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                    @foreach ($category as $item)
                        <option value="{{$item->id}}"
                            @if (isset($post))
                                @if ($item->id==$post->category_id)
                                    selected                                
                                @endif 
                            @endif
                        >
                        {{$item->name}}</option>
                    @endforeach
                </select>
            </div>

            @if ($tags->count()>0)
                <div class="form-group">
                    <label for="tags">Tag</label>
                    <select class="form-control tags-select" name="tag[]" id="tag" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{$tag->id}}">
                                {{$tag->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="form-group">
                <button class="btn btn-success">        
                    {{isset($post)?'Update Post':'Create Post'}}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection


@section('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> 
        <script>
            flatpickr('#published_at',{
                enableTime :true
            })
            $(document).ready(function() {
                $('.tags-select').select2();
            });
        </script>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection
