<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsuarioResource;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        try {
            $fields = $request->only(['username', 'password', 'retyped_password']);

            $rules = [
                'username' => 'required|min:6|max:32|unique:usuarios',
                'password' => 'min:6|required_with:retyped_password|same:retyped_password',
            ];

            $validator = Validator::make($fields, $rules);

            if($validator->fails()) {
                throw new Exception($validator->errors());
            }

            $hash = password_hash($fields['password'], PASSWORD_BCRYPT);
            $fields['password'] = $hash;

            $usuario = Usuario::create($fields);

            if($usuario !== null) {
                return resourceResponse(UsuarioResource::make($usuario), 201);
            } else {
                throw new Exception('Não foi possível criar usuário.');
            }

        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id) : JsonResponse
    {
        try {
            $usuario = Usuario::find($id);
            if($usuario !== null) {
                return resourceResponse(UsuarioResource::make($usuario));
            } else {
                return errorResponse('Usuário não encontrado.', 404);
            }
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Usuario $usuario
     * @return JsonResponse
     */
    public function update(Request $request, Usuario $usuario) : JsonResponse
    {
        try {
            $fields = $request->only(['username', 'password']);

            $rules = [
                'username' => 'min:6|max:32|unique:usuarios',
                'password' => 'min:6',
            ];

            $validator = Validator::make($fields, $rules);

            if($validator->fails()) {
                throw new Exception($validator->errors());
            }

            if($usuario->update($fields)) {
                return resourceResponse(UsuarioResource::make($usuario));
            } else {
                throw new Exception('Não foi possível atualizar o usuário.');
            }
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Usuario $usuario
     * @return JsonResponse
     */
    public function destroy(Usuario $usuario) : JsonResponse
    {
        try {
            if($usuario->delete()) {
                return resourceResponse(UsuarioResource::make($usuario));
            } else {
                throw new Exception('Não foi possível excluir o usuário.');
            }
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }
}
