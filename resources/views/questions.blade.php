@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add a question
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Question Form -->
                    <form action="{{ url('question')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Question Text -->
                        <div class="form-group">
                            <label for="text" class="col-sm-3 control-label">Question</label>

                            <div class="col-sm-6">
                                <input placeholder = "{{$random_placeholder}}" type="text" name="text" id="text" class="form-control" value="{{ old('question') }}">
                            </div>
                        </div>

                        <!-- Add Question Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Question
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Questions -->
            @if (count($questions) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Questions 
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Question</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                    <tr>
                                        <td class="table-text"><a href = "{{ url('question', [$question->id]) }}">{{ $question->text }}</a></td>
                                        <td class="text-right"><span class="badge badge-primary">{{$question->answers->count()}} answers</span></td>
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
