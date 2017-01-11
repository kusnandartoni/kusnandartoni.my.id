<?php

	function summary(){
		$data = array(
	        'tr' => '190000',
	        'index'  => 'COMPOSITE'
	    );
	    // use key 'http' even if you send the request to https://...
	    $options = array(
	    	'http' => array(
	        	'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
	        	'method'  => 'POST',
	        	'content' => http_build_query($data),
	    	),
	    );
	    $context  = stream_context_create($options);
	    $result = file_get_contents("https://mobile.bcasekuritas.co.id/json/trproc.php", false, $context);
	    $rslt = json_decode($result,true);
	    $hsl = $rslt['out'][0];
	    return ("<b>SUMMARY</b>\n==================\nIndex\t\t\t\t\t\t\t: $hsl[index]\nChange\t\t\t: $hsl[chgP]$hsl[chg]\nchg Rate\t: $hsl[chgP]$hsl[chgR]\n==================\nPrev\t\t\t\t\t\t\t\t\t: $hsl[prevPrice]\nOpen\t\t\t\t\t\t\t\t: $hsl[open]\nHigh\t\t\t\t\t\t\t\t\t: $hsl[high]\nLow\t\t\t\t\t\t\t\t\t\t: $hsl[low]\n==================\nup\t\t\t\t\t\t\t\t\t\t\t\t\t\t: $hsl[up]\ndown\t\t\t\t\t\t\t\t\t: $hsl[down]\nunchange\t: $hsl[unchg]\nno trade\t\t\t\t: $hsl[noTrd]\n
	    ");
	}
	//summary();
	$replyMarkup = array(
	    'keyboard' => array(
	        array("A", "B")
	    ),
	    "resize_keyboard" => true,
	    "one_time_keyboard" => true
	);
	$encodedMarkup = json_encode($replyMarkup);
	print_r($encodedMarkup);
	$data = array(
        'chat_id' => '281922927',
        'parse_mode' => 'HTML',
        'markup_reply' => $encodedMarkup,
        'text'  => summary()
    );
    // use key 'http' even if you send the request to https://...
    $options = array(
    	'http' => array(
        	'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        	'method'  => 'POST',
        	'content' => http_build_query($data),
    	),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents("https://api.telegram.org/bot274953553:AAHajO-HyA0LUSzN9cQq3wvAYB-LXnzPptc/sendMessage", false, $context);
    print_r($result);
?>