<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FaqTopic;
use App\Faq;
use Auth;
use DB;

class FaqController extends Controller
{
   public function index()
    {
        $faq = Faq::paginate(50);
        return view('admin.faq.index',compact('faq'));
    }


     public function create()
    {
        $faqtopic = FaqTopic::all();
        return view('admin.faq.create', compact('faqtopic'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'topic'=>'Required',
            'question'=>'Required',
			'answer'=>'Required',
        ]);

        $content = new Faq;
        
        $content->topic = $request->topic;
        $content->question = $request->question;
        $content->answer = $request->answer;
        $content->created_at = date('Y-m-d H:i:s');
        $content->updated_at = date('Y-m-d H:i:s');
        $content->save();

        return redirect('administration/faq');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contentData = Faq::find($id);
        $faqtopic = FaqTopic::all();
		
        $mid = $contentData->topic;
        $menuData = FaqTopic::where('slug',$mid);
        return view('admin.faq.edit',compact('contentData', 'faqtopic','menuData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request, [
            'topic'=>'Required',
            'question'=>'Required',
			'answer'=>'Required',
        ]);

        $content = Faq::find($id);

        $contentUpdate = array(
            'topic'=>$request->topic,
            'question'=>$request->question,
            'answer'=>$request->answer,
            'updated_at'=>date('Y-m-d H:i:s')
        );
        $content->update($contentUpdate);

        return redirect('administration/faq');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $content = Faq::find($id);
        $content->delete();
        return redirect('administration/faq');
    }
}
