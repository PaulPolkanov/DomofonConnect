<?php

namespace App\Http\Controllers;

use App\Models\ChatUser;
use App\Services\TenantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class miniAppTelegramController extends Controller
{
    public function index(Request $request){
        if($request->chat_id){
            $userdata = ChatUser::where('chat_id', $request->chat_id)->first();
            if($userdata->phone){
                $idTenant = TenantService::checkTenant($userdata->phone);
                if( !isset($idTenant['error'])){
                    $dataApartment = TenantService::getApartment($idTenant);
                    $arayDomofons = TenantService::getDomofons($idTenant, $dataApartment[0]['id']);
                    $arrPhotoDomofon = [];
                    foreach($arayDomofons as $item){
                        $arrPhotoDomofon[$item['id']] = TenantService::getPohotDomofon($item['id'], $idTenant);
                    }
                    return view('pages.getStart', ['id' => $request->chat_id, "domofons" => $arayDomofons, 'photos' => $arrPhotoDomofon, "tenat_id" => $idTenant]);
                } else {
                   return view('pages.authError', ['erorrs' => "not tenant"]);
                }
                
            }
            return view('pages.authError', ['erorrs' => "not phone"]);
        }
        return view('pages.authError', ['erorrs' => "not auth"]);
        
    }
    public function open_domofon(Request $request){
        if($request->chat_id){
            $userdata = ChatUser::where('chat_id', $request->chat_id)->first();
            if($userdata->phone){
                $idTenant = TenantService::checkTenant($userdata->phone);
                $resalt = TenantService::openDomofon($request->domofon_id, $idTenant);
                return $resalt;
            }
        }
        return "error";
    }
}
