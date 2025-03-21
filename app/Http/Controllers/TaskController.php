<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\UserController\getid;
class TaskController extends Controller
{
    
    public function store(Request $request)
    {
        try{
      $data=$request->all();
        $task = new Task();
        $task->title = $data['title'];
        $task->description =$data['discription'];
        $task->status = $data['status'];
        $task->userid = auth()->id();
        $task->save();
 
        return response()->json(['success' => true, 'message' => 'Task created successfully.', 'task' => $task], 201);
        }
        catch(\Exception $e){
            
        }
    } 
    public function update(Request $request,$id)
    {
        $task=Task::find($id);
        if(!$task){
            return response()->json(["message"=>"Task not Present"]);
        }
      
        $task->update($request->only(['title', 'description', 'status']));
        return response()->json(["message"=>'Task Updated']);
    }

    public function delete($id)
    {
      $task = Task::find($id);
      if (!$task) {
        return response()->json(["message" => "Task not found"]);
      }
      $task->delete();
      return response()->json(["message" => "Task deleted successfully"], 200);
} 

}
