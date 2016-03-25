<?php 
$link = mysql_connect( 'mysql.clinicaldevelopmentnavigator.com', 'cdnwebadmin', '45Un@oi&gR') or die('Could not connect to server.' );
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('cdnwp', $link) or die('Could not select database.');

$title = $_POST["time"];
$content = $_POST["url"];
$date = date('Y-m-d H:m:s');
if($title != ''){
	$sql = "INSERT INTO wp_posts(post_title, post_content, post_date, post_status, post_type) VALUES('$title', '$content', '$date', 'publish', 'post')";
	mysql_query($sql);
}
mysql_close($link);

?>