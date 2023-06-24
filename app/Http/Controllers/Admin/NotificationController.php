<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class NotificationController extends BaseController
{
    public function index(){
        $notifications = Notification::get();
        $this->setPageTitle('Notification', 'Notification');
        return view('admin.notifications.index', compact('notifications'));
    }
    public function store(Request $request){
        $this->validate($request, [

            'title' =>  'required',
            'notification' => 'required',
            'link' =>  'required',
            'category' => 'required',
            'university' => 'required',
        ]);
        try{
        $notification = new Notification();
        $notification['title'] = $request->title;
        $notification['notofication'] = $request->notofication;
        $notification['link'] = $request->link;
        $notification['category'] = $request->category;
        $notification['university'] = $request->university;
        $notification->save();
        return $this->responseRedirect('admin.pdfs.index', 'pdf added successfully' ,'success',false, false);

    } catch (QueryException $exception) {
        return $this->responseRedirectBack('Error occurred while creating pdf.', 'error', true, true);
    }
    }
}
