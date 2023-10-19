<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Area;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function index()
    {
        $data['title'] = 'Question & Answer';
        $data['breadcrumb'] = 'qna';
        $data['areas'] = Area::get();

        return view('dashboard.qna', $data);
    }

    function question(Request $request, Area $area)
    {

        $data['title'] = 'Questions ' . ucfirst($request->status ?? 'active') . ' in ' . $area->area_name . ' (' . $area->area_code . ')';
        $data['breadcrumb'] = 'question';
        $data['area_id'] = $area->id;
        if ($request->status == 'inactive') {
            $data['question'] = $area->question()->onlyTrashed()->get();
        } else {
            $data['question'] = $area->question;
        }
        $data['status'] = $request->status ?? 'active';

        return view('dashboard.question', $data);
    }

    function activeQuestion($id)
    {
        $question = Question::onlyTrashed()->find($id);
        $area_id = $question->area_id;
        $total_question = Question::where('area_id', '=', $area_id)->count();
        $question->numbering = $total_question + 1;
        $question->save();
        $question->restore();
        return redirect('/question/' . $area_id . '?status=inactive')->with('message', 'Berhasil mengaktifkan question');
    }

    function inactiveQuestion($id)
    {
        $question = Question::find($id);
        $area_id = $question->area_id;
        $numbering = $question->numbering;
        $question->numbering = null;
        $question->save();
        $question->delete();
        Question::where('numbering', '>', $numbering)->where('area_id', '=', $area_id)->update(['numbering' => DB::raw('`numbering`-1')]);
        return redirect('/question/' . $area_id . '?status=active')->with('message', 'Berhasil menonaktifkan question');
    }

    function createQuestion(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required',
            'weight' => 'required',
        ]);
        $data = $request->except('_token');
        $data['numbering'] = Question::where('area_id', '=', $request->area_id)->count() + 1;
        $save = Question::create($data);
        if ($save) {
            return redirect("/question/$request->area_id")->with('message', 'Berhasil mendaftarkan question baru');
        }
        return back()->onlyInput();
    }

    function editQuestion(Request $request, $id)
    {
        $validated = $request->validate([
            'question' => 'required',
            'weight' => 'required',
            'numbering' => 'required'
        ]);

        $question = Question::find($id);
        $question->question = $request->question;
        $question->weight = $request->weight;

        $cur_numbering = $question->numbering;
        $new_numbering = $request->numbering;
        $question->numbering = $request->numbering;
        if ($cur_numbering != $new_numbering) {
            if ($cur_numbering > $new_numbering) {
                Question::where('numbering', '>=', $new_numbering)->where('numbering', '<', $cur_numbering)->where('area_id', '=', $question->area_id)->update(['numbering' => DB::raw('`numbering`+1')]);
            }
            if ($cur_numbering < $new_numbering) {
                Question::where('numbering', '<=', $new_numbering)->where('numbering', '>', $cur_numbering)->where('area_id', '=', $question->area_id)->update(['numbering' => DB::raw('`numbering`-1')]);
            }
            // Question::where('numbering', '>', $cur_numbering)->update(['numbering' => DB::raw('`numbering`+1')]);
        }

        if ($question->save()) {
            return redirect("/question/$question->area_id")->with('message', 'Berhasil mengubah question');
        }
        return back()->onlyInput();
    }

    function answer(Question $question)
    {
        $data['title'] = 'Answer';
        $data['breadcrumb'] = 'answer';
        $data['question'] = $question;

        return view('dashboard.answer', $data);
    }

    function createAnswer(Request $request)
    {
        $validated = $request->validate([
            'answer' => 'required',
            'point' => 'required',
        ]);
        $data = $request->except('_token');
        $save = Answer::create($data);
        if ($save) {
            return redirect("/answer/$request->question_id")->with('message', 'Berhasil mendaftarkan answer baru');
        }
        return back()->onlyInput();
    }

    function editAnswer(Request $request, $id)
    {
        $validated = $request->validate([
            'answer' => 'required',
            'point' => 'required',
        ]);

        $answer = Answer::find($id);
        $answer->answer = $request->answer;
        $answer->point = $request->point;

        if ($answer->save()) {
            return redirect("/answer/$answer->question_id")->with('message', 'Berhasil mengubah answer');
        }
        return back()->onlyInput();
    }
}
