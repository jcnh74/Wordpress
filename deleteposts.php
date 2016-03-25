<?php
$link = mysql_connect( 'mysql.clinicaldevelopmentnavigator.com', 'cdnwebadmin', '45Un@oi&gR') or die('Could not connect to server.' );
//$link = mysql_connect( 'localhost', 'jcnh74', 'surfer') or die('Could not connect to server.' );

if (!$link) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('cdnwp', $link) or die('Could not select database.');
//mysql_select_db('wordpress', $link) or die('Could not select database.');


$sql = "DELETE FROM wp_posts WHERE post_type =  'post'";
mysql_query($sql);

mysql_close($link);


?>