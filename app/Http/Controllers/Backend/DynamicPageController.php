<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DynamicPage;
use Illuminate\Http\Request;

class DynamicPageController extends Controller
{
    public function index()
    {
        return view('Backend.Layouts.Dynamicpage.index');
    }

    public function data()
    {
        if (request()->ajax()) {
            return datatables()->of(DynamicPage::latest()->get())
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $editBtn = '<a href="' . route('dynamic_page.edit', $data->id) . '" class="edit btn btn-secondary btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>';


                    // Status button with icon based on active/deactive status
                    if ($data->status == 'active') {
                        $statusBtn = '<a href="' . route('dynamicpage.status', $data->id) . '" class="btn btn-success btn-sm" >
                                <i class="fa fa-check-circle"></i> Active
                              </a>';
                    } else {
                        $statusBtn = '<a class="btn btn-danger btn-sm" href="' . route('dynamicpage.status', $data->id) . '">
                                <i class="fa fa-times-circle"></i> Deactive
                              </a>';
                    }

                    return $editBtn . '  ' . $statusBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

  public function edit($id)
  {
        $page = DynamicPage::find($id);
        return view('Backend.Layouts.Dynamicpage.edit', compact('page'));
    }

  public function update(Request $request, $id){
      $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ]);
        $dynamicpage = DynamicPage::find($id);
        $dynamicpage->title = $request->title;
        $dynamicpage->slug = rand().$request->slug;
        $dynamicpage->description = $request->description;
        $dynamicpage->save();
        toastr()->success('Dynamic Page Updated Successfully');
        return redirect()->back();
  }




    public function StatusChange($id){

        $dynamicpage = DynamicPage::find($id);
        if($dynamicpage->status == 'active'){
            $dynamicpage->status = 'inactive';
        }else{
            $dynamicpage->status = 'active';
        }
        $dynamicpage->save();
        toastr()->success('Status Changed Successfully');
        return redirect()->back();
    }
}
