<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Http\Request;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'id_number' => 'required|numeric',
            'password' => 'required',
        ]);

        $user = User::where('id_number', $request->id_number)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            // throw ValidationException::withMessages([
            //     'email' => ['The provided credentials are incorrect.'],
            // ]);
            //if authentication is unsuccessfull, notice how I return json parameters
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or password',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $user->createToken($request->device_name)->plainTextToken,
            'user' =>  $user
        ]);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|unique:users|regex:/(0)[0-9]{10}/',
            'id_number' => 'required|numeric|unique:users,id_number',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            // 'device_name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken($request->device_name)->plainTextToken;
        return response()->json([
            'success' => true,
            'token' => $success,
            'user' => $user
        ]);
    }


    public function validateUser(Request $request)
    {

        $id = $request->query('id');

        $client = new \GuzzleHttp\Client();
        $res = $client->get('http://10.65.70.120/hudumaapi/citizen/read_one.php?id= '. $id . '&accesskey=H9950P4bx3LiZJRr7UddmjXhBoewoq0O:Brh6zdIjGvze5PBuzc7NqGh3oWxUtEa7chzuzw4SN7MdO6k7UPjduHYx4hzmNsgv');
        echo $res->getStatusCode(); // 200
        echo $res->getBody(); // { "type": "User", ....
    }
}
