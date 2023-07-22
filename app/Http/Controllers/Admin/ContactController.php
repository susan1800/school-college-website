<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class ContactController extends BaseController
{
    public function index(){

        $contacts = ContactMessage::latest()->get();
        $this->setPageTitle('User Message', 'User Message');
        return view('admin.contacts.index', compact('contacts'));

        // return view('admission',compact('about','courses'));
    }
}
