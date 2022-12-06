<?php

// Initialize URL to the variable
$url = $_SERVER['REQUEST_URI'];
	
// Use parse_url() function to parse the URL
// and return an associative array which
// contains its various components
$url_components = parse_url($url);

// Use parse_str() function to parse the
// string passed via URL
parse_str($url_components['query'], $params);
	
switch($params['socialNet'])
{
  case '1' :
      header("Location: https://www.facebook.com/");
      exit();
      break;
  case '2' :
      header("Location: https://www.twitter.com.com/");
      exit();
      break;
  case '3' :
      header("Location: https://mx.linkedin.com/?src=go-pa&trk=sem-ga_campid.19001150288_asid.143806640876_crid.636777052015_kw.linkedin_d.c_tid.kwd-148086543_n.g_mt.e_geo.1010204&mcid=7000592715335761922&cid=&gclid=EAIaIQobChMIlt7O8Kba-wIVlYlaBR0Nugh0EAAYASAAEgIEbvD_BwE&gclsrc=aw.ds");
      exit();
      break;
  default :
      header("Location: ../");
      break;
}
?>
