<?php

namespace App\Models\Sandbox;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class ApiClient extends Model
{
    use HasFactory;

    public static function cretePlans($reference = null, $params = [])
    {
        $email = config('pagseguro.email');
        $token = config('pagseguro.token');

        $response = Http::withHeaders([
            'Accept' => 'application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1',
            'Conten-Type' => 'application/json',
        ])->post(
            "https://ws.sandbox.pagseguro.uol.com.br/pre-approvals/request/?email=$email&token=$token",
            [
                'reference' => $reference,
                'preApproval' => $params,
            ]
        );

        return $response;
    }
}
