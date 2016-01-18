#!/usr/bin/php5
<?php
$inputfile = file('input.iif');
$outputfile = fopen('output.iif', 'w');

foreach($inputfile as &$line) {
    $line = preg_replace('/.*AUTOSTAX.*/','',$line);
    $line = preg_replace('/- Project Planning & Management/','- Project Management',$line);
    $line = preg_replace('/- Development & Site Building/','- Development',$line);
    $line = preg_replace('/WP - Wordpress Maintenance - hourly/','WP - Maintenance - hourly',$line);
    $line = includeAccount($line);
    fwrite($outputfile, $line);
}

fclose($outputfile);

function includeAccount($line) {
	$account = "";
	
	$exploded = explode("\t", $line);
  if ($exploded[0] == "SPL" && $exploded[4] == "Consulting Income") {
    switch ($exploded[13]) {
			case "C - Content Porting & Addition":
			case "C - Rush Content Porting & Addition":
				$account = "Content Porting";
				break;
			case "CiviCRM Support Plan":
				$account = "Drupal - Flat Rate Income";
                break;
            case "Deposit":
                $account = "Project Deposit";
                break;

			case "CP - Development":
			case "CP - Free Work":
			case "CP - Meetings and Phone Calls":
			case "CP - Out of Contract":
			case "CP - Project Management":
			case "CP - Research & Consulting":
			case "CP - Rush Work":
			case "CP - Training & Documentation":
				$account = "CiviCRM Projects";
				break;
			case "CS - Development":
			case "CS - Free Work":
			case "CS - Meetings and Phone Calls":
			case "CS - Project Management":
			case "CS - Research & Consulting":
			case "CS - Rush Work":
			case "CS - Training & Documentation":

				$account = "CiviCRM Hourly Support";
                break;
            case "CSP - Off Contract":
            case "CSP - Included Work to X hours":
                $account = "CiviCRM Maintenance Extra Work";
                break;
            case "CSP - On Contract":
            case "CiviCRM Maintenance Plan":
            case "CSP - Community Support":
				$account = "CiviCRM Flat Rate Income";

			    break;

			case "DCP - Development":
			case "DCP - Free Work":
			case "DCP - Meetings and Phone Calls":
			case "DCP - Project Management":
			case "DCP - Research & Consulting":
			case "DCP - Rush Work":
			case "DCP - Training & Documentation":
			case "DCP - Project Management":
				$account = "Drupal/Civi Project";
				break;
			case "DCS - Development":
			case "DCS - Free Work":
			case "DCS - Meetings and Phone Calls":
			case "DCS - Project Management":
			case "DCS - Research & Consulting":
			case "DCS - Rush Work":
			case "DCS - Training & Documentation":
			case "DCS - Project Management":
				$account = "Drupal/Civi Support";
				break;
			case "Discount":
				$account = "";
				break;
			case "DP - Development":
			case "DP - Free Work":
			case "DP - Meetings and Phone Calls":
			case "DP - Project Management":
			case "DP - Research & Consulting":
			case "DP - Rush Work":
			case "DP - Training & Documentation":
				$account = "Drupal Project";
				break;
			case "Drupal Support Plan":
            case "DP - Flat rate":
            case "Drupal Maintenance Plan":
                $account = "Drupal - Flat Rate Income";
                break;
            case "DSP - Rush Work":
            case "DSP - Off Contract":
            case "DSP - Included work to X hours":
            case "DSP - Free Work":
                $account = "Drupal Support Plan - Extra Work";
				break;
			case "DS - Development":
			case "DS - Free Work":
			case "DS - Meetings and Phone Calls":
			case "DS - Project Management":
			case "DS - Research & Consulting":
			case "DS - Rush Work":
			case "DS - Site Updates & Maintenance":
			case "DS - Training & Documentation":
				$account = "Drupal Hourly Support";
				break;
			case "E - E-commerce Development":
            case "E - Free Work":
            case "E - Rush Work":
			case "E - Meetings and Phone Calls":
			case "E - Project Management":
			case "E - Research & Consulting":
				$account = "E-Commerce";
				break;
			case "MSP - New Desktop Setup":
				$account = "MSP - New Desktop Setup";
				break;
			case "Managed Service":
				$account = "MSP - Flat Rate Income";
				break;
			case "M - Development":
			case "M - Free Work":
			case "M - Meetings and Phone Calls":
			case "M - Project Management":
			case "M - Research & Consulting":
			case "M - Rush Work":
			case "M - Training & Documentation":
            case "M - Training":
            case "Training":

			
				$account = "Miscellaneous Development";
                break;
            case "MSP - off contract":
            case "MSP - Included work to X hours":
                $account = "Managed Service - Extra work";
                break;
			case "TS - Free Work":
			case "TS - Onsite Support":
			case "TS - Meetings and Phone Calls":
			case "TS - Project Management":
			case "TS - Remote Support":
			case "TS - Research & Consulting":
			case "TS - Rush Work":
				$account = "Tech Support Hourly";
                break;
            case "VPS Maintenance Plan":
                $account = "VPS Maintenance Plan";
                break;
            case "Plan Setup":
                $account = "Drupal or Civi Plan Setup";
                break;
			case "VPS - Rush Support":
			case "VPS - Support":
				$account = "VPS Hourly Support";
				break;
			case "WP - Maintenance - hourly":	
				$account = "Wordpress - hourly support";
				break;
		} 	
	  	
		if ($account == "") {
  		echo "Account not found: $exploded[13]\n";
		} else {
    	$line = preg_replace('/Consulting Income/',$account,$line);
		}
	}
	return $line;
}
?>
