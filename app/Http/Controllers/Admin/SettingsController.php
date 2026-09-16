<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;


class SettingsController extends Controller
{
    public function __invoke(Request $request)
    {
        $token = $request->header('X-Admin-Token');

        if ($token !== 'chave-super-secreta') {

            Log::warning('Tentativa de invasão detectada (Admin)', [
                'ip' => $request->ip(),
                'user-agent' => $request->userAgent(),
                'url_acessada' => $request->fullUrl(),
                'token_tentado' => $token ?? 'Nenhum token enviado'
            ]);

            return response()->json(['erro' => 'Acesso não autorizado'], 401);

        }

        return response()->json(['configuracoes' => 'Dados sigilosos aqui']);
    }
}
