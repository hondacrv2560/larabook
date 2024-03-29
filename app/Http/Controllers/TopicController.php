<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Block;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics=Topic::all();
        $id=0;
        return view('topic.index', ['page'=>'home','topics'=>$topics, 'id'=>$id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topic=new Topic;
        return view('topic.create', ['topic'=>$topic,'page'=>'AddTopic']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $topic = new Topic; //create empty model object
////initialize the model's property topicname
////with data entered into form's control
////topicname
////we have access to form controls through
////$request parameter
//        $topic->topicname=$request->topicnameform;
//        $topic->save();

        $topic = new Topic;
        $topic->topicname = $request->topicname;
//if saving to DB table failed
        if (!$topic->save()) {
            $err = $topic->getErrors();
//get errors descriptions
            return redirect()->//go back to the form with error messages
            action('TopicController@create')->
            with('errors', $err)->withInput();
        }
        return redirect()->
//if saving to DB table was successful
        action('TopicController@create')->
        with('message', 'New topic ' . $topic->topicname . ' has been added with id=' . $topic->id . '!');
//go back to the form with success message

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blocks = Block::where('topicid', '=', $id)->get();
        $topics = Topic::all();
        return view('topic.index', ['page'=>'Main page', 'topics'=>$topics, 'id'=>$id, 'blocks'=>$blocks]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

//    use App\Bloa;
    public function search(Request $request)
    {
        $search = $request->searchform;
        $search = '%' . $search . '%';
        $topics = Topic::where('topicname', 'like', $search)->get();
        return view('topic.index', ['page' => 'Main Page', 'topics' => $topics, 'id' => 0]);
    }
}
