<? 
$MYSQL = array(
'host' => '127.0.0.1',
'user' => 'sklimedw_strsity',
'pass' => 'y80jI&Gz8Qui',
'dataBase' => 'sklimedw_strsity'
);
$link = mysql_connect($MYSQL['host'], $MYSQL['user'], $MYSQL['pass']); 
mysql_select_db($MYSQL['dataBase']); mysql_set_charset('utf8');
$query = mysql_query("SELECT * FROM `navigation` ORDER BY `id` DESC LIMIT 1") or die(mysql_error()); $navigation = ''; 
while ($data = mysql_fetch_assoc($query)) $navigation .= $data['text'].'<br>';
$query = mysql_query("SELECT * FROM `orderform` ORDER BY `id` DESC LIMIT 1") or die(mysql_error()); $orderform = ''; 
while ($data = mysql_fetch_assoc($query)) $orderform .= $data['text'].'<br>';
$query = mysql_query("SELECT * FROM `faq` ORDER BY `id` DESC LIMIT 1") or die(mysql_error()); $faq = ''; 
while ($data = mysql_fetch_assoc($query)) $faq .= $data['text'].'<br>';
$query = mysql_query("SELECT * FROM `video-atlant` ORDER BY `id` DESC LIMIT 1") or die(mysql_error()); $video = ''; 
while ($data = mysql_fetch_assoc($query)) $video .= $data['text'].'<br>';
$query = mysql_query("SELECT * FROM `reviewsbath` ORDER BY `id` DESC LIMIT 1") or die(mysql_error()); $reviewsbath = ''; 
while ($data = mysql_fetch_assoc($query)) $reviewsbath .= $data['text'].'<br>';
$query = mysql_query("SELECT * FROM `footersite` ORDER BY `id` DESC LIMIT 1") or die(mysql_error()); $footersite = ''; 
while ($data = mysql_fetch_assoc($query)) $footersite .= $data['text'].'';
$query = mysql_query("SELECT * FROM `cssjs` ORDER BY `id` DESC LIMIT 1") or die(mysql_error()); $cssjs = ''; 
while ($data = mysql_fetch_assoc($query)) $cssjs .= $data['text'].'';
?>