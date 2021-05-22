<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('is_valid_call')){

	function is_valid_call($aPost)
	{
		$response = 0;
		if (isset($aPost) && count($aPost) > 0 && $aPost['apiKey'] == APIKEY) {
			$response = 1;
		}
		return $response;
	}

}

/*
Get QR Code
*/
function get_qr_code($order_id = 0, $title = "BCR Events",$width=200,$height=200)
{
	$url = base_url() . "home/verify_ticket/" . $order_id;
	$chl = @urlencode($url);
	return '<img src="https://chart.googleapis.com/chart?chs='.$width.'x'.$height.'&cht=qr&chl=' . $chl . '&choe=UTF-8" title="' . $title . ' " />';
}



/*
Get List of youtube video
*/
function get_youtube_videos(){
		$google_api_key='AIzaSyDoLnrq9O3cxv0AeVcyGCMo2NysOD0IVPs';
		$youtube_channel_id= 'UCFL-TJjzBY626RIx1c3W4DA';//'UCe0tc23_rhJUwI_IdmEbqWA';
		$api='https://www.googleapis.com/youtube/v3/search?key='.$google_api_key.'&channelId='.$youtube_channel_id.'&part=snippet,id&order=date&maxResults=20';

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $api,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET"			
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err; exit;
		} else {
			$response=json_decode($response);
			$response=$response->items;			 
		}
		$aVideo=array();
		foreach ($response as $key => $value) {
			$temp=new StdClass();
			
			$temp->video_id=$value->id->videoId;
			$temp->video_url='http://www.youtube.com/watch?v='.$temp->video_id;
			$temp->embed_video_url='http://www.youtube.com/embed/'.$temp->video_id.'?rel=0';		
			$temp->title=$value->snippet->title;
			$temp->published_on=$value->snippet->publishedAt;
			$temp->description=$value->snippet->description;
			$temp->thumbnails=$value->snippet->thumbnails;
			
			$aVideo[]=$temp;
		}
		return $aVideo;
	}

