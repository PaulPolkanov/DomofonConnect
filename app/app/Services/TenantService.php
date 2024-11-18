<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class TenantService
{
    public static function checkTenant($phone)
    {
        $url = "https://domo-dev.profintel.ru/tg-bot/check-tenant";
        $payload = [
            'phone' => $phone,
        ];
        $headers = [
            'x-api-key' => 'SecretToken',
        ];

        $response = Http::withHeaders($headers)->post($url, $payload);

        if ($response->successful()) {
            return $response->json()['tenant_id'];
        } else {
            return ['error' => 'Request failed', 'status' => $response->status()];
        }
    }
    public static function getApartment($tenant_id)
    {
        $url = "https://domo-dev.profintel.ru/tg-bot/domo.apartment?tenant_id=".$tenant_id;
        $headers = [
            'x-api-key' => 'SecretToken',
        ];

        $response = Http::withHeaders($headers)->get($url);

        if ($response->successful()) {
            return $response->json();
        } else {
            return ['error' => 'Request failed', 'status' => $response->status()];
        }
    }
    public static function getDomofons($tenant_id, $apartment_id )
    {
        $url = "https://domo-dev.profintel.ru/tg-bot/domo.apartment/$apartment_id/domofon?tenant_id=".$tenant_id;
        $headers = [
            'x-api-key' => 'SecretToken',
        ];

        $response = Http::withHeaders($headers)->get($url);

        if ($response->successful()) {
            return $response->json();
        } else {
            return ['error' => 'Request failed', 'status' => $response->status()];
        }
    }
    public static function openDomofon($domofon_id, $tenant_id)
    {
        $url = "https://domo-dev.profintel.ru/tg-bot/domo.domofon/$domofon_id/open?tenant_id=$tenant_id";
        $payload = [
            "door_id" => 0,
        ];
        $headers = [
            'x-api-key' => 'SecretToken',
        ];

        $response = Http::withHeaders($headers)->post($url, $payload);

        if ($response->successful()) {
            return $response->json()['msg'];
        } else {
            return ['error' => 'Request failed', 'status' => $response->status()];
        }
    }
    public static function getPohotDomofon($domofon_id, $tenant_id)
    {
        $url = "https://domo-dev.profintel.ru/tg-bot/domo.domofon/urlsOnType?tenant_id=".$tenant_id;
        $payload = [
            'intercoms_id' => [ $domofon_id],
            "media_type" => ["JPEG"]
        ];
        $headers = [
            'x-api-key' => 'SecretToken',
        ];

        $response = Http::withHeaders($headers)->post($url, $payload);

        if ($response->successful()) {
            return $response->json()[0]['jpeg'];
        } else {
            return ['error' => 'Request failed', 'status' => $response->status()];
        }
    }
    
}