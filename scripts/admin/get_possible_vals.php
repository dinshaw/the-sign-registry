<?php
//GET ALL POSSIBLE VALIDATIONS

//SELECT ALL SUBMISSIONS FROM ALL RECIPIENTS WHO HAVE RECIEVED SIGNS FROM THE REGISTRANT OF THIS SIGN
//signID => rec_id, rec_id => sub_id
$sql = "
SELECT sub.text AS text
FROM submissions sub, signs s
WHERE s.id = '$signID' AND s.rec_id = sub.rec_id  
";

$query = mysql_query($sql);

$submissions = array();
while($rows = mysql_fetch_array($query)){
	$submission = array();
	
	$submission['text'] = $rows['text'];
	
	$submissions[] = $submission;
}
$tpl->assign('submissionLoop', $submissions);
	



?>