<?php
include_once('ais.2.php');

$ais = new AIS();

# https://www.navcen.uscg.gov/?pageName=AISMessagesA
# http://www.aggsoft.com/ais-decoder.htm
# http://www.gps-coordinates.org/
# https://www.darrinward.com/lat-long/?id=2670307
# https://github.com/tbsalling/aismessages/wiki

// An Example Of Generating Message 24
// User ID	366730000	
// Navigation Status	5	Moored
// Rate of Turn (ROT)	-729	
// Speed Over Ground (SOG)	20.8	
// Position Accuracy	0	An unaugmented GNSS fix with accuracy > 10 m
// Longitude	-122.392531666667	West
// Latitude	37.8038033333333	North
// Course Over Ground (COG)	51.3	
// True Heading (HDG)	511	Not available (default)

// Message ID 6 Identifier for Message 24; always 24
// Repeat indicator 2 Used by the repeater to indicate how many times a message has been
// repeated. 0 = default; 3 = do not repeat any more
// User ID 30 MMSI number
// Part number 2 Identifier for the message part number; always 0 for Part A
// Name 120 Name of the MMSI-registered vessel. Maximum 20 characters 6-bit
// ASCII, @@@@@@@@@@@@@@@@@@@@ = not
// available = default
// Number of bits 160 Occupies one-time period 
$message_type = 1;
$repeat_indicator = 0; 
$user_id = 351759000; 
$nav_status = 0; 
$rate_return = 2;
$sog = 0;
$position_accuracy = 0;
$name = 'ASIAN JADE';

$url = basename($_SERVER['REQUEST_URI']);
$lat_index = strrpos($url, "lat");
$lon_index = strrpos($url, "lon");

$lat = substr($url, $lat_index+4, $lon_index-$lat_index-5); 
$lon = substr($url, $lon_index+4); 

$enc = '';
$enc .= str_pad(decbin($message_type), 6, '0', STR_PAD_LEFT);
$enc .= str_pad(decbin($repeat_indicator), 2, '0', STR_PAD_LEFT);
$enc .= str_pad(decbin($user_id), 30, '0', STR_PAD_LEFT);
$enc .= str_pad(decbin($nav_status), 4, '0', STR_PAD_LEFT);
$enc .= str_pad(decbin($rate_return), 8, '0', STR_PAD_LEFT);
$enc .= str_pad(decbin($sog), 10, '0', STR_PAD_LEFT);
$enc .= str_pad(decbin($position_accuracy), 1, '0', STR_PAD_LEFT);
$enc .= str_pad(decbin($ais->mk_ais_lon( $lon )), 28, '0', STR_PAD_LEFT);
$enc .= str_pad(decbin($ais->mk_ais_lat( $lat )), 27, '0', STR_PAD_LEFT);

$enc .= str_pad(decbin(0), 12, '0', STR_PAD_LEFT);
$enc .= str_pad(decbin(0), 9, '0', STR_PAD_LEFT);
$enc .= str_pad(decbin(0), 6, '0', STR_PAD_LEFT);
$enc .= str_pad(decbin(0), 2, '0', STR_PAD_LEFT);
$enc .= str_pad(decbin(0), 3, '0', STR_PAD_LEFT);
$enc .= str_pad(decbin(0), 1, '0', STR_PAD_LEFT);
$enc .= str_pad(decbin(0), 19, '0', STR_PAD_LEFT);


//Test Code
// echo $enc.'<br/>';
// echo "id= " . bindec(substr($enc,0,6)) . "<br/>";
// echo "mmsi= " . bindec(substr($enc,8,30)) . "<br/>";
// echo "name= " . binchar($enc,40,120) . "<br/>";

// WARNING: it may not appear correct if displayed on browser due to the '<' character.
// Use browser view source and the full AIS string will be shown.
echo $ais->mk_ais($enc);

?>
