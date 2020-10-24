<?php 
$name = filter_var($_POST['uname'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$marketing = filter_var($_POST['marketing'], FILTER_SANITIZE_STRING);
$srnews = filter_var($_POST['srnews'], FILTER_SANITIZE_STRING);
$vacancies = filter_var($_POST['vacancies'], FILTER_SANITIZE_STRING);
$peggy = filter_var($_POST['peggy'], FILTER_SANITIZE_STRING);

if($marketing != 'Yes') { $marketing = 'No'; }
if($srnews != 'Yes') { $srnews = 'No'; }
if($vacancies != 'Yes') { $vacancies = 'No'; }
if($peggy != 'Yes') { $peggy = 'No'; }

$url = 'https://api.elasticemail.com/v2/email/send';

try{
        $post = array('from' => 'aline@alinechaves.com',
		'fromName' => 'Aline Ribeiro',
		'apikey' => '670201E60D0531A037043EC3B9B4D54E8CED69C1DE6D9E243371D56F507B0397771F0666CB3B25122A103860558F5CE8',
		'subject' => 'Contact Form',
		'to' => 'hello@studiorepublic.com',
		'bodyHtml' => '<h1>New Subscriber</h1><p>Name: '.$name.'</p><p>Email: '.$email.'</p><p>Consent to receive emails: '.$marketing.'</p><p>SR news: '.$srnews.'</p><p>Vacancies: '.$vacancies.'</p><p>Peggy: '.$peggy.'</p>',
		'bodyText' => 'New Subscriber Name: '.$name.'\n Email: '.$email.' \n Consent to receive emails: '.$marketing.' \n SR news: '.$srnews.' \n Vacancies: '.$vacancies.' \n Peggy: '.$peggy,
		'isTransactional' => false);
		
		$ch = curl_init();
		curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $post,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
			CURLOPT_SSL_VERIFYPEER => false
        ));
		
        $result=curl_exec ($ch);
        curl_close ($ch);
		
        echo $result;	
}
catch(Exception $ex){
	echo $ex->getMessage();
}

?>