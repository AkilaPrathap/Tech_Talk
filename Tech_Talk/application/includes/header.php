<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title; ?></title>
<link rel="stylesheet" href="<?= base_url() ?>css/main.css" />
<script src="<?= base_url() ?>js/jquery-2.1.3.min.js"></script>
<script src="<?= base_url() ?>js/main.js"></script>

</head>
<body>
<div id="wrapper">
<div id="header">
<div id="nav">
<ul id="top_links">
	<li><a href="https://localhost/CW/Tech_Talk/index.php/home">Home</a></li>
	<li><a href="https://localhost/CW/Tech_Talk/index.php/categories">Browse categories</a></li>
	<li><a href="https://localhost/CW/Tech_Talk/index.php/questions/post_question">Post question</a></li>
	<li><a href="https://localhost/CW/Tech_Talk/index.php/guest_search">Guest Search</a></li>
<?php
if(isset($logged_in) && $logged_in){
echo "<li><a href=\"https://localhost/CW/Tech_Talk/index.php/profile/view/" . $user_id . "\">" . "Profile</a></li>";
echo "<li><a href=\"https://localhost/CW/Tech_Talk/index.php/logout\">Logout</a></li>";
}
else{
echo "<li><a href=\"https://localhost/CW/Tech_Talk/index.php/register\">Register</a></li>";
echo "<li><a href=\"https://localhost/CW/Tech_Talk/index.php/login\">Login</a></li>";
}
?>
</ul>
</div>
<div id="search">
	<form id="header_form" action="https://localhost/CW/Tech_Talk/index.php/search/term\" method="get">
	<input type="text" id="header_input" placeholder="search" />
	<input type="submit" name="submit" value="Search" />
	</form>
</div>
</div>
