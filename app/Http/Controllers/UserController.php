<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
     
      public function signup(Request $request){
          $data=$request->all();
          $validator = Validator::make($request->all(), [
          'name' => 'required|string|max:20',
           'email'=>'required|email|unique:user,email',
          'password' => 'string|min:6',
         
      ]);

      if ($validator->fails()) {
         return response()->json([
             'message' => 'Validation failed',
             'errors' => $validator->errors()
         ]);
     }
  
   
      try{
         $count = User::where('email', $data['email'])->first();
         if ($count) {
         return response()->json(["message" => "EmailExists"],200); 
         }
         $data['password']=bcrypt($data['password']);
         User::create($data);
         $userdata= User::where('email', $data['email'])->first();
         return response()->json(['message'=>'success','id'=>$userdata['id']]);
    
}
      catch(\Exception $e){
      return response()->json(['error' => $e->getMessage()]);

   }
 
}

public function login(Request $request){

   $logindata=$request->all();
   $validator = Validator::make($logindata, [
      'email' => 'nullable|string',
      'password' => 'string|min:6',
     
  ]);

  if ($validator->fails()) {
     return response()->json([
         'message' => 'Validation failed',
         'errors' => $validator->errors()
     ]);
 }

   try{
    $data=User::where("email",$logindata['email'])->firstOrFail();
    if($data['email']==$logindata['email']&& Hash::check($logindata['password'],$data['password'])){
       $token =$data->createToken('token-name', ['server:update'])->plainTextToken; 
       return response()->json(['message'=>'success',
                                'Token'=>$token,
                                'id'=>$data['id'],
                                'email'=>$logindata['email']]);
      }
    else{
       return response()->json(['message'=>'Invalid credentials']);
   }
  }
    catch(\Exception $e){
    return response()->json(["message"=>'Loginfail',"Error"=>$e->getMessage()]);
   }
}
          
 }

