<?php

$post_fields = array('sal' => 'Mr.','firstName' => 'John','lastName' => 'Doe','address' => '123 Fake St','address2' => '#1','city' => 'Springfield','state' => 'KY','country' => 'US','zip' => '12345','tel' => '212 555 1212','tel2' => '917 432 5432','email' => 'reg@dinshawdesign.com','tc' => 'yes','dob_day' => '12','dob_month' => '12','dob_year' => '1970',/*recipient error messages*/'sal_2' => 'Ms.','firstName_2' => 'Jannis','lastName_2' => 'Doely','address_2' => '432 Other Ave.','address2_2' => '#33','city_2' => 'New Jersey','state_2' => 'NY','country_2' => 'US','zip_2' => '12346','tel_2' => '212 555 1212','tel2_2' => '965 432 2345','email_2' => 'rec@dinshawdesign.com');
	

foreach($post_fields as $key => $val){
		$tpl->assign($key,$val);
}

?>