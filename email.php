<?php
$link = mysql_connect( 'mysql.clinicaldevelopmentnavigator.com', 'cdnwebadmin', '45Un@oi&gR') or die('Could not connect to server.' );
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('cdnwp', $link) or die('Could not select database.');


$firstname = $_POST['firstname'];
$acceptance = $_POST['acceptance'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$country = $_POST['country'];
$linkurl = $_POST['linkurl'];
$linkcopy = $_POST['linkcopy'];

$html = file_get_contents('email-template.html');

$html = str_replace('[linkurl]', $linkurl, $html);
$html = str_replace('[linkcopy]', $linkcopy, $html);

$headers = "";
$headers .= "From: Bayer HealthCare <noreply@clinicaldevelopmentnavigator.com>\r\n";
$headers .= "Reply-To: noreply@clinicaldevelopmentnavigator.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$success = mail($email, "The information you requested from the Bayer HealthCare exhibit", $html, $headers);

$title = $firstname . ' ' . $lastname;
$content = '<p>Name: ' . $title . '</p><p>Email: ' . $email . '</p><p>Country: ' . $country . '</p><p>Link Requested: '. $linkurl . '</p><p>Did Accept: ' . $acceptance . '</p>';
$date = date('Y-m-d H:m:s');
if($title != ''){
	$sql = "INSERT INTO wp_posts(post_title, post_content, post_date, post_status, post_type) VALUES('$title', '$content', '$date', 'publish', 'email')";
	mysql_query($sql);
}
mysql_close($link);

?>