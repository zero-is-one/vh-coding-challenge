<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use App\Question;
use App\Answer;
use Illuminate\Http\Request;

Route::group(['middleware' => ['web']], function () {
    /*****************************************
     *
     *  This all should go in controllers.....
     *
     *****************************************/

    Route::get('/', function () {
        $random_placeholders = [
            'At what time do ducks wake up? ',
            'What do you call a duck that steals? ',
            'What did the duck detective say to his partner? ',
        ];

        return view('questions', [
            'questions' => Question::orderBy('created_at', 'desc')->get(),
            'random_placeholder' => $random_placeholders[array_rand($random_placeholders)],
        ]);
    });

    Route::post('/question', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'text' => 'required|max:255|ends_with:?',
        ], [
            'ends_with' => 'A question is required to end with a question mark ',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $question = new Question();
        $question->text = $request->text;
        $question->save();

        return redirect('/');
    });

    Route::get('/question/{id}', function ($id) {
        return view('question', [
            'question' => Question::find($id),
            'answers' => Question::find($id)->answers,
        ]);
    })->name('get.question');

    Route::post('/question/{question_id}/answer', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'text' => 'required|min:5',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        $answer = new Answer();
        $answer->text = $request->text;
        $answer->question_id = $request->question_id;
        $answer->save();

        return redirect()->back();
    })->name('post.answer');
});
