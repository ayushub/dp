<?php
$url='YOUR_URL';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($curl, CURLOPT_HEADER, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$data = curl_exec($curl);
//curl_close($curl);

preg_match_all('|Set-Cookie: (.*);|U', $data, $matches);
$cookies = implode('; ', $matches[1]);
$cookies = $cookies . "; c3po=r2d2";
echo $cookies;
//print_r($matches);

//calculate

$html = $data;
$dom = new DOMDocument();

@$dom->loadHTML($html);

$finder = new DOMXPath($dom);
$nodes = $finder->query('//p');

$question_string =  $nodes->item(2)->nodeValue;
//echo $question_string;

$arr = substr($question_string, 9);
//echo $arr;
//sscanf($arr, "%d * %d + %d",$v1, $v2, $v3);
$ast = strpos($arr, "*");
$pls = strpos($arr, "+");
$v1 = intval(substr($arr, 1, 2));
$v2 = intval(substr($arr, $ast + 3, 2));
$v3 = intval(substr($arr, $pls + 3,2));
//var_dump($v1, $v2, $v3);

$result = ($v1*$v2) + $v3;
//echo $result;

$res = array('title' => 'submit', 'jobref' => 'po33', 'value' => $result);
print_r($res);


//send result
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($curl, CURLOPT_HEADER, true);  
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $res);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($curl, CURLOPT_COOKIE, $cookies);
$data = curl_exec($curl);
echo $data;

?>
