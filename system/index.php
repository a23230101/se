<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Panel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/system/file/bootstrap.min.css">
  <link rel="stylesheet" href="/system/file/signin.css">
    <script src="/system/file/jquery.min.js"></script>
    <script src="/system/file/bootstrap.min.js"></script>

</head>
<body>
<?php
error_reporting(0);
session_start();
require_once 'ys.php';

if (isset($_GET['logout']))logout('login-ys-2016');
authorize('login-ys-2016');
echo '
<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="#">Admin</a>
</div>
<div id="navbar" class="collapse navbar-collapse">
<ul class="nav navbar-nav">
<li><a href="/system">Home</a></li>
<li><a href="?config=1">Seting</a></li>
<li><a href="?ads=1">Iklan</a></li>
<li><a href="?sitemap=1">Sitemap</a></li>
<li><a href="?uset=1">User</a></li>
<li><a href="?logout=1">Logout</a></li>
</ul>
</div>
</div>
</nav>
';
//
if (isset($_GET['config'])) {
if (isset($_POST['saveconfig'])) {
include("config/config.php");
echo (update_config($_POST['config'], $config)) ? "
<div class='container'>
<div class='starter-template'><center>Configuration have been saved!, Please <a href='?config=1'>klik here</a> to view</center></div></div>" : "<div class='container'><div class='starter-template'><center>Please check your CHMOD!</center></div>
";
} else {
include("config/config.php");

echo "
<div class='container'>
<div class='starter-template'>
<form method='post'>
<div class='form-group'>
<label class='pwd'>Tittle:</label>
<input type='text' class='form-control' name='config[1]' value='".$config['1']."'>
</div>

<div class='form-group'>
<label class='pwd'>Tagline:</label>
<input type='text' class='form-control' name='config[2]' value='".$config['2']."'>
</div>

<div class='form-group'>
<label class='pwd'>Deskripsi:</label>
<input type='text' class='form-control' name='config[3]' value='".$config['3']."'>
</div>

<div class='form-group'>
<label class='pwd'>Random Search:</label>
<input type='text' class='form-control' value='".$config['random']."' disabled>
</div>

<div class='form-group'>
<label class='pwd'>Total Search * 2:</label>
<input type='text' class='form-control' value='".$config['total']."' disabled>
</div>


<div class='form-group'>
<label class='pwd'>Api Youtube:</label>
<input type='text' class='form-control' value='api 1, api2, api3, api4, api5' disabled>
</div>

<div class='form-group'>
<label class='pwd'>Api Soundcould:</label>
<input type='text' class='form-control' value='api 1, api2, api3, api4, api5' disabled>
</div>

<div class='form-group'>
<label class='pwd'>Random Search:</label>
<input type='text' class='form-control' value='".$config['randomsearch']."' disabled>
</div>

<div class='form-group'>
<label class='pwd'>Token:</label>
<input type='text' class='form-control' value='".$config['botch']."' disabled>
</div>

<div class='form-group'>
<label class='pwd'>Signature:</label>
<input type='text' class='form-control' value='".$config['signature']."' disabled>
</div>

<div class='form-group'>
<label class='pwd'>Related:</label>
<input type='text' class='form-control'value='".$config['11']."' disabled>
</div>

<div class='form-group'>
<label class='pwd'>Headtag:</label>
<input type='text' class='form-control' value='".$config['headtag']."' disabled>
</div>
<button type='submit' name='saveconfig' class='btn btn-default'>Save</button>
</form>
</div>
</div>
";
}
}
////////////////////////////////
elseif (isset($_GET['ads'])) {
if (isset($_POST['saveconfig'])) {
include("config/ads.php");
echo (update_config($_POST['ads'], $ads)) ? "
<div class='container'>
<div class='starter-template'><center>Configuration have been saved!, Please <a href='?ads=1'>klik here</a> to view</center></div></div>" : "<div class='container'>
<div class='starter-template'><center>Please check your CHMOD!</center></div>
"; } else {
include("config/ads.php");
echo "
<div class='container'>
<div class='starter-template'>
<form method='post'>

<div class='form-group'>
<label class='pwd'>Ads (pc):</label>
<textarea class='form-control' rows='5' disabled>".$ads['ads1']."</textarea>
</div>

<div class='form-group'>
<label class='pwd'>Ads (mobile):</label>
<textarea class='form-control' rows='5' disabled>".$ads['ads2']."</textarea>
</div>

<div class='form-group'>
<label class='pwd'>Ads 2 (mobile):</label>
<textarea class='form-control' rows='5' disabled>".$ads['ads3']."</textarea>
</div>

<div class='form-group'>
<label class='pwd'>Text:</label>
<textarea class='form-control' rows='5' disabled>".$ads['ads4']."</textarea>
</div>

<div class='form-group'>
<label class='pwd'>Link (andro):</label>
<textarea class='form-control' rows='5' disabled>".$ads['la']."</textarea>
</div>

<div class='form-group'>
<label class='pwd'>Link (else):</label>
<textarea class='form-control' rows='5' disabled>".$ads['lo']."</textarea>
</div>


<button type='submit' name='saveconfig'class='btn btn-default'>Save</button>
</form>
</div>
</div>
";
}
}
///////////////////////////////
elseif (isset($_GET['sitemap'])) {
echo "
<div class='container'>
<div class='starter-template'>
";
if($_POST['link']){
$content = file_get_contents('sitemap/data/sitemap');
$added = "".$_POST["link"]."\n".$content;
$open = fopen('sitemap/data/sitemap', 'w');
fwrite($open, "$added");
fclose($open);
$totalSiteMap = count(explode(urldecode('%0A'), $content));
echo "
<p class='lead'>Total $totalSiteMap Sitemap Added</p>
";
} else {
echo "
<p class='lead'>Add Sitemap</p>
";
} echo "
<form method='post'>
<div class='form-group'>
<input class='form-control' type='text' name='link' value='http://".$_SERVER["HTTP_HOST"]."/'>
</div>
<input type='submit' class='btn btn-lg btn-primary btn-block' value='Sumbit'>
</form>
</div></div>";
exit;
}
//////////////////////////////
elseif (isset($_GET['uset'])) {
if (isset($_POST['saveconfig'])) {
include("config/admin.php");
echo (update_config($_POST['admin'], $admin)) ? "
<div class='container'>
<div class='starter-template'><center>Configuration have been saved!, Please <a href='?uset=1'>klik here</a> to view</center></div></div>" : "<div class='container'>
<div class='starter-template'><center>Please check your CHMOD!</center></div>
"; } else {
include("config/admin.php");
echo "
<div class='container'>
<div class='starter-template'>
<form method='post'>

<div class='form-group'>
<label class='pwd'>Username:</label>
<input type='text' class='form-control' value='".$admin['user']."' disabled>
</div>

<div class='form-group'>
<label class='pwd'>Password:</label>
<input type='text' class='form-control' value='".$admin['password']."' disabled>
</div>

<div class='form-group'>
<label class='pwd'>Site: [".$admin['site']."]</label>
<select class='form-control' disabled>
  <option value='ON'>ON</option>
  <option value='OFF'>OFF</option>
</select>
</div>
<button type='submit' name='saveconfig'class='btn btn-default'>Save</button>
</form>
</div>
</div>
";
}
}
///////////////////////////////
else {
include 'include/readme';
}
///////////////////////////////


