<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SendNote;
use App\Http\Controllers\BaseController;

class SendNoteController extends BaseController
{
    public function index(){
        $sendnotes = SendNote::latest()->get();
        $this->setPageTitle('Send Notes', 'Send Notes');
        return view('admin.sendnotes.index',compact('sendnotes'));
    }


    
    public function delete($id){
        try{

        $sendnote = SendNote::find($id);
        
            $sendnote->delete();
            return "success";
    } catch (QueryException $exception) {
        return "error";
    }

    }
}
