<?php

namespace App\Http\Controllers\Admin;

use App\Models\FeedbackUser;
use App\Models\User;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class FeedbackController extends BaseController
{

    public function getUserFeedback(){
        $feedbacks = FeedbackUser::latest()->get();
        $this->setPageTitle('feedbacks', 'What user say about us !');
        return view('admin.feedbacks.index', compact('feedbacks'));
    }





    public function disable($id){
        try{
        $Feedback = FeedbackUser::find($id);
        if($Feedback['status']=='1'){
            $Feedback['status']='0';
        }
        else{
            $Feedback['status']='1';
        }

        $Feedback->save();
        return $this->responseRedirectBack('status updated sucessfully.', 'sucess', false, false);
    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while updating status Feedback.', 'error', true, true);
    }

    }

    public function delete($id){
        try{

        $Feedback = FeedbackUser::find($id);
            $Feedback->delete();
            return "success";



    } catch (QueryException $exception) {
        return "error";
    }

    }


}
