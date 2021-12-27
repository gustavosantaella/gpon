<?php

namespace App\Http\Controllers\Admin;

use App\Models\Answer;
use App\Models\AnswerLine;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;

class AnswerController extends BaseController
{
    public function ApprovedOrDecline()
    {
        $this->request()->validate([
            'approved'=>'required',
            'answerIsLine'=>'required',
            'object_id' => 'required',
        ]);
        try {

            if($this->request()->answerIsLine == true)
            {
                $answer = AnswerLine::find($this->request()->object_id);
            }else{
                $answer = Answer::find($this->request()->object_id);
            }

                $approved = (bool)$this->request()->approved;
                $answer->approved = $approved;
                $answer->update();
                $message = $approved ? 'Aprobado' : 'Declinado';
                return back()->with('menssage', $message);





        } catch (\Throwable $th) {

            return back()->with('error', $th->getMessage());
        }
    }
}
