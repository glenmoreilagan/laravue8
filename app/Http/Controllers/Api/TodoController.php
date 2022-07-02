<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $todos = Todo::all();
      return json_encode(['todos' => $todos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $todo = new Todo;
      $todo->todo = $request->todoDesc;
      $todo->save();

      if (!$todo) {
        return response()->json(['status' => false, 'msg' => 'Saving Failed!']);
      }

      return response()->json(['status' => true, 'msg' => 'Saving Success!', 'todos' => $todo]);
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
      $todo = Todo::findOrFail($id);

      if (!$todo) {
        return response()->json(['status' => false, 'msg' => 'Fetch Failed!']);
      }
      return response()->json(['status' => true, 'msg' => 'Fetch Success!', 'todo' => $todo]);
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
      $todo = Todo::findOrFail($id);
      $todo->todo = $request->todoDesc;
      $todo->iscomplete = $request->isComplete;
      $todo->save();

      if (!$todo) {
        return response()->json(['status' => false, 'msg' => 'Update Failed!']);
      }

      return response()->json(['status' => true, 'msg' => 'Update Success!', 'todo' => $todo]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $delete_todo = Todo::where('id',$id)->delete();

      if (!$delete_todo) {
        return response()->json(['status' => false, 'msg' => 'Delete Failed!']);
      }
      return response()->json(['status' => true, 'msg' => 'Delete Success!']);
    }
}
