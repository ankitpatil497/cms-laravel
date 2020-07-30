
@extends('layouts.app')

@section('content')



<div class="d-flex justify-content-end">
    <a href="{{route('posts.create')}}" class="btn btn-success mb-2">Add Posts</a>
</div>
<div class="card card-default">
    <div class="card card-header">
        Post
    </div>
    <div class="card card-body">
       @if ($posts->count()>0)
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($posts  as $item)
                        <tr>
                            <td>
                                <img src="{{asset(URL::to('/storage/' .$item->image))}}" style="height:65px" width="80px" >
                            </td>
                            <td>
                                {{$item->title}}
                            </td>
                            <td>
                                <a href="{{route('categories.edit',$item->category->id)}}">
                                    {{$item->category->name}}
                                </a>
                            </td>
                            @if (!$item->trashed())
                            <td>
                                <a href="{{route('posts.edit',$item->id)}}" class="btn btn-info btn-sm">Edit</a>
                            </td>    
                             @else
                             <td>
                                <form action="{{route('restore-posts',$item->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-info btn-sm">Restore</button>

                                </form>
                            </td>                           
                            @endif
                            <td>
                                <form action="{{route('posts.destroy',$item->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        {{$item->trashed()     ? 'Delete':'Trash'}}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
           
       @else
           <h3 class="text-center">
               No Posts yet.....
           </h3>
       @endif
    </div>
    
@endsection