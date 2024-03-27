@extends('master')
@section('body')
    <div class="section py-5">
        <div class="container">
            <form action="{{route('todo.new')}}" method="POST">
                @csrf
            <div class="row">
                <h5 class="text-success text-center">{{Session::get('message')}}</h5>
                <div class="col-md-9">
                    <textarea name="todo" class="form-control" id="" cols="30" rows="3"></textarea>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary form-control">
                        Add Todo
                    </button>
                </div>

            </div>
            </form>
            <div class="row pt-5">
                <div class="col-md-12">
                    <h3>Pending Todos</h3>
                    <hr>

                    <div class="row">
                    @foreach($todos as $todo)
                        @if($todo->status==0)
                    <div class="col-md-3 my-2">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h4 class="card-title">{{$todo->todo}}</h4>

                                <p class="card-text"><span class="fw-bold">Created at:</span> <br> {{ \Carbon\Carbon::parse($todo->created_at)->toDayDateTimeString()}}</p>

                                <div class="d-flex">
                                    <form action="{{route('todo.done')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="1">
                                        <input type="hidden" name="id" value="{{$todo->id}}">
                                        <button type="submit" class="btn btn-primary" title="Mark Done">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                    </form>
                                    <a href="{{route('todo.edit', ['id' => $todo->id])}}" class="btn btn-secondary mx-2" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="{{route('todo.delete', ['id' => $todo->id])}}" class="btn btn-danger" title="Delete" onclick="return confirm('Ary you sure to delete this!');"><i class="fa-solid fa-trash"></i></a>
                                </div>

                            </div>
                        </div>
                    </div>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col-md-12">
                    <h3>Completed Todos</h3>
                    <hr>

                    <div class="row">
                        @foreach($todos as $todo)
                            @if($todo->status==1)
                                <div class="col-md-3 my-2">
                                    <div class="card bg-success text-white">
                                        <div class="card-body">
                                            <h4 class="card-title">{{$todo->todo}} <i class="fa-solid fa-check"></i></h4>

                                            <p class="card-text"><span class="fw-bold">Completed at:</span> <br> {{ \Carbon\Carbon::parse($todo->updated_at)->toDayDateTimeString()}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
