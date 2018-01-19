<?php

class OneSignal {


    public static function init() {

        if (!isset($_SESSION['user_id'])) {
            return '<!-- /* not logged in */ -->';
        }

        $string = file_get_contents('javascripts/onesignal_init.js');
        $string = str_replace('[[[APP_ID]]]', ONESIGNAL_APP_ID, $string);
        return $string;
    }

    public static function send_to_player($player_id)
    {
        $content = array(
            "en" => 'Yo dude this one of them pushes we told you about !'
        );

        $fields = array(
            'app_id' => ONESIGNAL_APP_ID,
            'include_player_ids' => array($player_id),
            'contents' => $content
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic '.ONESIGNAL_REST_API_KEY));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);


        return $response;
    }


}