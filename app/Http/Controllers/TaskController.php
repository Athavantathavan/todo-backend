<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
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
        return response()->json(['success' => true,
                                 'message' => 'Task created successfully.', 
                                 'task' => $task], 201);
        }
        catch(\Exception $e){
          return response()->json(["message"=>$e->getMessage()]);
        }
    } 

    
    public function update(Request $request)
    {
      try{
        $task = Task::findOrFail($request->id);
        $task->update($request->only(['title', 'description', 'status']));
        return response()->json(['message' => 'Task updated successfully',
                                'task' => $task]);
      }
      catch(\Exception $e){
        return response()->json(["message"=>$e->getMessage()]);
      }
    }



    public function getdata($id)
    {
      try{
      $users = Task::where('userid', $id)->select('id', 'title','description','status')->get();
      return response()->json(["task"=>$users,
                               "success"=>'ok']);
      }
      catch(\Exception $e){
      return response()->json(["message"=>$e->getMessage()]);
      }
    }


    public function delete($id)
    {
      try{
      $task = Task::find($id);
      if (!$task) {
      return response()->json(["message" => "Task not found"]);
      }
      $task->delete();
      return response()->json(["message" => "Deleted"], 200);
     }
     catch(\Exception $e){
     return response()->json(["message"=>$e->getMessage()]);
  }


} 

}
