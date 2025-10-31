<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\PagesContent\UpdateRequest;
use App\Models\PagesContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PagesContentsController extends Controller
{

    public function getPageContent($section)
    {
        $pages_contents = PagesContent::where('section', $section)->get();
        $heading = $pages_contents->first();
        return view('super_admins.pages_contents.edit')->with('pages_contents', $pages_contents)->with('heading', $heading->page_title ?? $section);
    }


    public function update(UpdateRequest $request)
    {
        foreach ($request->data as $key => $value) {
            PagesContent::where('name', $key)->update(['value' => $value]);
        }
        return redirect()->back()->with('message', 'PagesContent Updated Successfully')->with('message_type', 'success');
    }
}
