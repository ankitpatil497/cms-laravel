@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card card-header">
            Users
        </div>
        <div class="card card-body">
           @if ($users->count()>0)
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                </thead>
                <tbody>
                    @foreach ($users  as $item)
                        <tr>
                            <td>
                                {{--  <img width="50px" height="50px" style="border-radius: 50%" src="{{Gravatar::src($item->email)}}" alt="">  --}}
                                {{--  {{Gravatar::src($item->email)}}  --}}
                                <img src="{{Gravatar::src($item->email) }}" alt="">
                            </td>
                            <td>
                                {{$item->name}}
                            </td>
                            <td>
                                {{$item->email}}
                            </td>
                            <td>
                                @if (!$item->isAdmin())
                                    {{$item->id}}
                                    <form action="{{route('makeadmin',$item->id)}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Make Admin</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
           @else
               <h3 class="text-center">
                   No User yett...
               </h3>
           @endif
        </div>
    </div>

    
@endsection