<html>
<head>
<title>Robot d'indexation Zinsearchbot</title>
</head>
<body>
<?php
if(empty($_POST['site']))
{
$site='http://www.yahoo.fr';
}
else
{
$site=$_POST['site'];
}

$code = file_get_contents($site);

$code = preg_replace('!'.$site.'!isU', '', $code);
preg_match('!<title>(.+)</title>!isU', $code, $title);
preg_match_all('!http://[A-Za-z0-9][A-Za-z0-9\-\.]+[A-Za-z0-9]\.[A-Za-z]{2,}[\43-\176]*+!isU', $code, $lien);
preg_match('!<meta name="description" content="(.+)"(.+)>!isU', $code, $description);
preg_match('!<meta name="keywords" content="(.+)"(.+)>!isU', $code, $clee);

$nb=count($lien[0]);

if(empty($title) || empty($description) || empty($clee) || $title[0] == '' || $description[0] == '' || $clee[0] == '')
{
echo'&bull; <font color="red">Une des balises n\'est pas fournie.</font><br/><br/>';
}
else
{

$title[0] = preg_replace('!<title>(.+)</title>!isU', '$1', $title[0]);
$description[0] = preg_replace('!<meta name="description" content="(.+)"(.+)>!isU', '$1', $description[0]);
$clee[0] = preg_replace('!<meta name="keywords" content="(.+)"(.+)>!isU', '$1', $clee[0]);


echo'&bull; <font color="red">Meta title : </font> '.$title[0].'';
echo'<br /><br />';
echo'&bull; <font color="red">Meta description :</font> '.$description[0].'';
echo'<br /><br />';
echo'&bull; <font color="red">Meta keywords :</font> '.$clee[0].'<br/><br/>';



$date=date('d/m/y');
include('mysql.php'); 
mysql_connect($host, $base, $passe);
mysql_select_db($db);
$requete = mysql_query("SELECT id,titre,description,adresse,key,source,date,ps FROM zinsearchbot WHERE adresse='$site'");
$reponse = mysql_num_rows($requete);

if($reponse == '0')
{
mysql_query("INSERT INTO zinsearchbot VALUES ('', '$title[0]', '$description[0]', '$site', '$clee[0]', '$date', '1')");
}
else
{
while ($donnes = mysql_fetch_array($requete) )
{
if($site == ''.$donnes['adresse'].'')
{
echo'';
}
else
{
$ps=$donnes['ps'];
$ps_=$ps+1;
$requete_ = mysql_query("UPDATE zinsearchbot SET ps = '$ps_' WHERE adresse = '$site'");
}
}
}
mysql_close();


}
if(empty($lien[0]))
{
echo'&bull; <font color="red">Aucun lien aproprié n\'a été trouvé.</font><br/>
 <form action="" method="GET"><input type="text" name="site" value="'.$site.'" size="117" /> <input type="submit" value="OK" /></form>
';
}
else
{
$aleatoire=rand(1, $nb);
$_lien=$lien[0][$aleatoire];

echo'&bull; <font color="red">Lien suivant : </font> '.$_lien.'<br/><br/>';
echo'&bull; <font color="red">Nombre de liens : </font>'.$nb.'<br/><br/>';




echo"<script language=\"JavaScript\">
setTimeout(\"window.location='zinsearchbot.php?site=$_lien'\",3000); 
</script>";



}
?>
<br/><br/>
<?php
if(!empty($lien))
{
?>
<div align="center"><font style="color:green; font-family:Arial;"><strong>Chargement...</strong></font></div>
<?php
}
else
{
?>
<div align="center"><font style="color:green; font-family:Arial;"><strong>Indexation stoppée...</strong></font></div>
<?php
}
?>
<br ><div align="center"><a href="index.php" style="color:red; text-decoration:none">X Stopper</a></div>
</body>
</html>