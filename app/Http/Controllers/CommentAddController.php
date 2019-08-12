<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentAddController extends Controller
{
    public function add()
    {
        $data = request()->all(); // запрос от клиента

        $this->validator($data)->validate();
        
        Comments::create($data);

        return response()->json(['success' => true]);
    }

    protected function validator($data)
    {
        $rules = [
            'text' => 'required|string|min:10|max:4000',
            'url' => 'required|max:100'
        ];
        return Validator::make($data, $rules);
    }
}
