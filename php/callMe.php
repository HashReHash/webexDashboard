<?php
        header("Content-Type: text/xml");

        $sitename = "apidemoeu";        //Sitename is the subdomain of a WebEx URL. ex: sitename for https://apidemoeu.webex.com is apidemoeu
        $username = "admin";
        $password = "password";
		$office = $_POST["office"];
		
        $XML ="<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
        $XML .="<serv:message xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">";
        $XML .="        <header>";
        $XML .="                <securityContext>";
        $XML .="                        <webExID>$username</webExID>";
        $XML .="                        <password>$password</password>";
        $XML .="                        <siteName>$sitename</siteName>";
        $XML .="                        <returnAdditionalInfo>TRUE</returnAdditionalInfo>";
        $XML .="                </securityContext>";
        $XML .="        </header>";
        $XML .="        <body>";
        $XML .="                <bodyContent xsi:type=\"java:com.webex.service.binding.user.SetUser\">"; 
		$XML .="				<webExId>374510</webExId>";
		$XML .="				<phones>";
		$XML .="				<phone>$office</phone>";
		$XML .="				</phones>";
		$XML .="				<options>";
		$XML .="				<workPhoneCallback>true</workPhoneCallback>";
		$XML .="				</options>";
		$XML .="                </bodyContent>";
        $XML .="        </body>";
        $XML .="</serv:message>";

        $request = stream_context_create(array("http"=>array("method"=>"POST","header"=>"Content-Type:text/xml","content"=>$XML)));

        $response = file_get_contents("https://$sitename.webex.com/WBXService/XMLService", false, $request);
		
		echo "Your office phone call me number is ".$office. ".";

?>