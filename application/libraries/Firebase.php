<?php

/**
 * @author Mubashir
 */
class Firebase
{

    public function __construct()
    {
        $this->CI = &get_instance();

    }

    // sending push message to single user by firebase reg id
    public function send($to, $message)
    {
        $fields = array(
            'to' => $to,
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }

    // Sending message to a topic by topic name
    public function sendToTopic($to, $message)
    {
        $fields = array(
            'to' => '/topics/' . $to,
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }

    // sending push message to multiple users by firebase registration ids
    public function sendMultiple($registration_ids, $message)
    {
        $fields = array(
            'to' => $registration_ids,
            'data' => $message,
        );

        return $this->sendPushNotification($fields);
    }

    // function makes curl request to firebase servers
    private function sendPushNotification($fields)
    {


        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        $headers = array(
            'Authorization: key=' . $this->CI->config->item('FIREBASE_API_KEY'),
            'Content-Type: application/json',
            'priority: high',
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));


        // shell_exec('curl -X POST --header "Authorization: key=<key here>" --header "Content-Type: application/json" https://fcm.googleapis.com/fcm/send -d "{\"to\":\"'.$fields['to'].'\",\"priority\":\"high\",\"notification\":{\"body\": \"'.stripslashes($fields['data']).'\"}}"');
//ss
        // Execute post
        $result = curl_exec($ch);
        if ($result === false) {
            die('Curl failed: ' . curl_error($ch));
        }
        else
        {
            //shell_exec('curl -X POST --header "Authorization: key=<key here>" --header "Content-Type: application/json" https://fcm.googleapis.com/fcm/send -d "{\"to\":\"'.$fields['to'].'\",\"priority\":\"high\",\"notification\":{\"body\": \"'.stripslashes($fields['data']).'\"}}"');
        }

        // Close connection
        curl_close($ch);

        return $result;
    }
}
