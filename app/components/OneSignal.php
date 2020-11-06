<?php

namespace App\components;

/**
 * Envia push notification
 */
class OneSignal 
{
    const APP_ID = "c7c1cfea-0f28-4d29-a622-512183e410f0";
    /**
     * One signal push notfication
     * 
     * Registra un push notification onesignal a 
     * un dispositivo en espesifico
     * oneSignalNotify
     */
    public static function notifyTo($player_id, $mensaje, $data = null, $dateTime = null){
		$content = array(
            "en" => $mensaje
        );
        $fields = array(
			'app_id' => self::APP_ID,
			'include_player_ids' => [
                $player_id
            ],
			'data' => $data,
            'contents' => $content,
		);
		if ($dateTime){
            $fields = array(
                'app_id' => self::APP_ID,
                'include_player_ids' => [
                    $player_id
                ],
                'data' => $data,
                'contents' => $content,
                'send_after'=> $dateTime
            );
        }
		
		$fields = json_encode($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
    }
    
    /**
     * One signal push notfication
     * 
     * Registra un push notification onesignal a 
     * un dispositivo en espesifico
     * oneSignalNotify
     */
    public static function notifyAll($players, $mensaje){
		$content = array(
            "en" => $mensaje
        );
        $fields = array(
			'app_id' => self::APP_ID,
			'include_player_ids' => [
                $player_id
            ],
			'data' => null,
            'contents' => $content,
		);
		
		$fields = json_encode($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
    }

    // oneSignalDeleteNofication
    public static function deleteNofication($notificacionId){
        $appId = self::APP_ID;
        $ch = curl_init();
        $httpHeader = array(
            'Authorization: Basic OWVjYzg0OTMtMTU0MS00OWI3LTk4N2ItN2VkMTBhODYzMTc4'
        );
        $url = "https://onesignal.com/api/v1/notifications/" . $notificacionId . "?app_id=" . $appId;

        $options = array (
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => $httpHeader,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_CUSTOMREQUEST => "DELETE",
        );
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);
    }
}
