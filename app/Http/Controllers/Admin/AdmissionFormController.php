<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Course;
use App\Models\Form;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Storage;

class AdmissionFormController extends BaseController
{
    public function index(){

        $forms = Form::latest()->get();
        $this->setPageTitle('Admission Form', 'Admission Form');
        return view('admin.admissionforms.index', compact('forms'));

        // return view('admission',compact('about','courses'));
    }

}
