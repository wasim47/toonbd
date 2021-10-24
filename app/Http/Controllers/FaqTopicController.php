<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FaqTopic;
use Auth;
use DB;

class FaqTopicController extends Controller
{
    public function index()
    {
        $faqtopic = FaqTopic::all();
        return view('admin.faqtopic.index',compact('faqtopic'));
    }

    public function create()
    {
        return view('admin.faqtopic.create');
    }

  
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'Required'
        ]);

        $mname = $request->name;
        $slug=strtolower(implode('-', explode(' ', $mname)));
        $m = new FaqTopic;
        
        $m->slug = $slug;
        $m->name = $request->name;
        $m->created_at = date('Y-m-d H:i:s');
        $m->updated_at = date('Y-m-d H:i:s');
        $m->save();

        return redirect('administration/faqtopic');
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $menu = FaqTopic::find($id);		
        return view('admin.faqtopic.edit',compact('menu'));
    }

  
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=>'Required'
        ]);


        $menu = FaqTopic::find($id);
        $slug = strtolower(implode('-', explode(' ', $request->name)));

        $menuUpdate = array(
			'name'=>$request->name,
            'slug'=>$slug
        );

        $menu->update($menuUpdate);
        return redirect('administration/faqtopic');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menuItem = FaqTopic::find($id);
        $menuItem->delete();
        return redirect('/mne/faqtopic');
    }
}
