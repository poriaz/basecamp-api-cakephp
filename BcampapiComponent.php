<?php
//this component may rquire modifications due to duplicay in code...but works fine
App::uses('Component', 'Controller');
//App::import('Vendor','basecamp-php-api-master/Basecamp.class.php');
//App::import('Vendor','basecamp-php-api-master/Basecamp.php');
//running include('../Vendor/base/basecampapi/Basecamp.php');
include('../Vendor/basecamp-php-api-master/Basecamp.class.php');
class BcampapiComponent extends Component
{
	
	
	function connectto($code = null)
	{
		      
			$basecamp = new Basecamp('MyBasecampIntegration');

			$basecamp->setOAuthAuthentication($_consumer_key,$_consumer_secret,'/allmessages');
			if($basecamp->authenticated) {
			   $token = $basecamp->fetchToken($_REQUEST['code']);$_SESSION['token'] = $token;$_SESSION['code'] = $_REQUEST['code'];
			   $acc = $basecamp->getAccounts();
			   $basecamp->setAccount($acc[0]->href);
                           return $basecamp->getProjects();
			} 
			else {
			      if (isset($_REQUEST['code'])) 
				{
					 $token = $basecamp->fetchToken($_REQUEST['code']);$_SESSION['token'] = $token;
					$acc = $basecamp->getAccounts();
					return $acc;
					$_SESSION['code'] = $_REQUEST['code'];
			   		//$basecamp->setAccount($acc[0]->href);
					// return $basecamp->getProjects();
				}
			      else if($code)
				{
					$token = $basecamp->fetchToken($code);$_SESSION['token'] = $token;
					$acc = $basecamp->getAccounts();
					return $acc;
			   		//$basecamp->setAccount($acc[0]->href);
					//return $basecamp->getProjects();
				}
			      
				else {
					$basecamp->redirectToDialog();	
				}	
			}

}

	function getprojects($code)
	{		
                $basecamp = new Basecamp('MyBasecampIntegration');
		$basecamp->setOAuthAuthentication($_consumer_key,$_consumer_secret,'/allmessages');
		$token = $basecamp->fetchToken($_REQUEST['code']);$_SESSION['code'] = $_REQUEST['code'];
		$acc = $basecamp->getAccounts();
					//return $acc;
					//pr($acc);
		$basecamp->setAccount(@$acc[0]->href);
		$_SESSION['token'] = $token;
		$_SESSION['oautha'] = $token->access_token;
		if($basecamp->authenticated) {
			   	$token = $basecamp->fetchToken($_REQUEST['code']);
					
				$acc = $basecamp->getAccounts();
					//return $acc;
					//pr($acc);
			   	$basecamp->setAccount($acc[0]->href);
				$pro = $basecamp->getProjects();//return $pro;
				$top = $basecamp->getProjectTopics($pro[0]->id);return $top;
		} 
	  	else if (isset($_REQUEST['code'])) 
		{	
				$basecamp = new Basecamp('MyBasecampIntegration');
				$basecamp->setOAuthAuthentication($_consumer_key,$_consumer_secret,'/allmessages');
				$token = $basecamp->fetchToken($_REQUEST['code']);
				$acc = $basecamp->getAccounts();
					//return $acc;
					//pr($acc);
			   	$basecamp->setAccount(@$acc[0]->href);
				$pro = $basecamp->getProjects();//return $pro;
				$top = $basecamp->getProjectTopics($pro[0]->id); return $top;
		}
		else  if($code)
		{    
				$basecamp = new Basecamp('MyBasecampIntegration');
				$basecamp->setOAuthAuthentication($_consumer_key,$_consumer_secret,'/allmessages');
				$token = $basecamp->fetchToken($code);
				$acc = $basecamp->getAccounts();
					//return $acc;
					//pr($acc);
			   	$basecamp->setAccount($acc[0]->href);
				$pro = $basecamp->getProjects();//return $pro;
				$top = $basecamp->getProjectTopics($pro[0]->id); return $top;
		} 
	}

	function replymessage($projectid,$subject,$message,$msgid,$code){
	//echo $projectid.",";echo $subject.",";echo $message.",";echo $msgid.",";echo $code;die;
	$basecamp = new Basecamp('MyBasecampIntegration');
	$basecamp->setOAuthAuthentication($_consumer_key,$_consumer_secret,'/allmessages');
	//$toke = $basecamp->fetchToken($code);
	//$token = $basecamp->refreshToken($toke);echo $token;
	//pr($basecamp);
	$acc = $basecamp->getAccounts();
	$basecamp->setAccount($acc[0]->href);
	
	$basecamp->createMessageComment($projectid,$msgid,$message);
	
	}
}
?>
