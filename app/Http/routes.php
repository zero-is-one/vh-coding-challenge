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
use Illuminate\Http\Request;

Route::group(['middleware' => ['web']], function () {
    /*
     * Show Question Dashboard
     */
    Route::get('/', function () {
        return view('questions', [
            'questions' => Question::orderBy('created_at', 'asc')->get(),
        ]);
    });

    /*
     * Add New Question
     */
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
});
