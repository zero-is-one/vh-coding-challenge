@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                   {{$question->text}}
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Question Form -->
                    <form action="{{ route('post.answer', $question->id)}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="text" class="col-sm-3 control-label">Add an Answer</label>

                            <div class="col-sm-6">
                                <input type="text" name="text" id="text" class="form-control" value="{{ old('answer') }}">
                            </div>
                        </div>
      
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Answer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if (count($answers) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Answers
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Answer</th>
                            </thead>
                            <tbody>
                                @foreach ($answers as $answer)
                                    <tr>
                                        <td class="table-text">{{ $answer->text }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
