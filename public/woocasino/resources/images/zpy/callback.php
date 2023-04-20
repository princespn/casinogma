<?php 
	
	$body = file_get_contents('php://input');

	/*
	$body = '{"data":{"type":"charge_unregistered","amount":"100","status":"success","currency":"EUR","metadata":{"userId":"43"},"created_at":"2021-08-15T21:33:18.529Z","order_slug":"client-438501c0-4a10-4bcc-b653-9378edc1fb49","state_code":0,"card_number":"437772******4043","is_completed":true,"original_amount":"100","original_currency":"EUR","payment_method_id":"pm_TbUkHH2V1KNAa8JdhnRKxh5CHkwuhPaYzoJb945MqALFTPAAZZJkztra","state_description":"No errors","checkout_session_id":"cs_live_PhL6faqQ8dy7aJdTpLAnQ7vNQ8K6FtzVhib8R4h5bAiRvPqwKayRXVcq"},"type":"order","event_at":"2021-08-15T21:33:46.897Z"}';*/
    $data = json_decode($body);

    $status = $data->data->status;
if($status == 'success') {

   	$userid = $data->data->metadata->userId;
    $balance = $data->data->amount / 100;
	
	

	

	
	$link = mysqli_connect("localhost", "us73", "letmein123", "gs73");

	$sql = 'UPDATE w_users SET balance = balance + '.$balance.' WHERE id = '.$userid.'';
	$result = mysqli_query($link, $sql);
	$fp = fopen('/var/www/casino/public/file.txt', 'a');
	fwrite($fp, $body . PHP_EOL);
	fclose($fp);
if ($result == false) {
    print("Произошла ошибка при выполнении запроса");
}
}
