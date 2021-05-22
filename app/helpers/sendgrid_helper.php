<?php

if (!function_exists('sendSendgridEmail')) {

    /*
      $arrParam = array(
      'api_user' => $user,
      'api_key' => $pass,
      'to' => 'example@sendgrid.com',
      'subject' => 'test of file sends',
      'html' => '<p> the HTML </p>',
      'text' => 'the plain text',
      'from' => 'example@sendgrid.com',
      'files[' . $fileName . ']' => '@' . $filePath . '/' . $fileName
      );
     */

    function sendSendgridEmail($arrParam = array())
    {
        $url = 'https://api.sendgrid.com/';
        $user = 'spitechws';
        $pass = 'idontknow#123';
        $request = $url . 'api/mail.send.json';
        $arrParam['api_user'] = $user;
        $arrParam['api_key'] = $pass;
        // Generate curl request
        $session = curl_init($request);
        // Tell curl to use HTTP POST
        curl_setopt($session, CURLOPT_POST, true);
        // Tell curl that this is the body of the POST
        curl_setopt($session, CURLOPT_POSTFIELDS, $arrParam);
        // Tell curl not to return headers, but do return the response
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        // obtain response
        $response = curl_exec($session);
        curl_close($session);
        $strRetMessage = json_decode($response);
        if (isset($strRetMessage->message) and $strRetMessage->message == 'success') {
            return 'success';
        } else {
            return 'fail';
        }
    }

}
