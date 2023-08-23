<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar las credenciales del usuario
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciales inválidas'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'No se pudo crear el token'], 500);
        }
        $user = JWTAuth::user();
        $userId = $user->id;
        $userRoleId = \DB::table('role_user')->select('role_id')->where('user_id', $userId)->get();
        $userRoleId = $userRoleId[0]->role_id;
        return response()->json([
            'message' => 'Autenticación exitosa',
            'token' => $token,
            'user_id' => $userId,
            'user_roles' => $userRoleId,
        ], 200);
    }
    
    public function register(Request $request)
    {
        $response = $this->login($request);
        $status = $response->getStatusCode();
        $roles = $response->original['user_roles'];
        if($status===200){
            if($roles===1){
                // Crear el nuevo usuario
                $requiredFields = ['name', 'newuseremail', 'newuserpassword'];
                if (!$request->has($requiredFields)) {
                    return response()->json(['error' => 'Campos requeridos faltantes'], 400);
                }
                $user = new User();
                $user->name = $request->input("name");
                $user->email = $request->input("newuseremail");
                $user->password = bcrypt($request->input("newuserpassword"));
                $user->save();

                return response()->json(['message' => 'Registro exitoso'], 201);
            }
            else{
                return response()->json(['message' => 'Sin los permisos suficientes para ésta operación']);
            }
        }
        else{
            return $status;
        }

    }
    public function update(Request $request, $id)
    {
        $response = $this->login($request);
        $status = $response->getStatusCode();
        $roles = $response->original['user_roles'];
        if($status===200){
            if($roles===1){
                $user = User::find($id);
                if (!$user) {
                    return response()->json(['error' => 'Usuario no encontrado'], 404);
                }
                $requiredFields = ['name', 'newuseremail', 'newuserpassword'];
                if (!$request->has($requiredFields)) {
                    return response()->json(['error' => 'Campos requeridos faltantes'], 400);
                }
                $user->name = $request->input("name");
                $user->email = $request->input("newuseremail");
                $user->password = bcrypt($request->input("newuserpassword"));
                $user->save();

                return response()->json(['message' => 'Modificacion exitosa'], 201);
            }
            else{
                return response()->json(['message' => 'Sin los permisos suficientes para ésta operación']);
            }
        }
        else{
            return $status;
        }

    }
    public function delete(Request $request, $id)
    {
        $response = $this->login($request);
        $status = $response->getStatusCode();
        $roles = $response->original['user_roles'];
        if($status===200){
            if($roles===1){
                $user = User::find($id);
                if (!$user) {
                    return response()->json(['error' => 'Usuario no encontrado'], 404);
                }
                \DB::table('role_user')->where('user_id', $id)->delete();
                $user->delete();
                return response()->json(['message' => 'Usuario eliminado exitosamente'], 200);
            }
            else{
                return response()->json(['message' => 'Sin los permisos suficientes para ésta operación']);
            }
        }
        else{
            return $status;
        }

    }
    public function read(Request $request)
    {
        $users = User::all();
        return response()->json($users, 200);
    }
}
