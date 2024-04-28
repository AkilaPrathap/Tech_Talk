<div id="content">
<?php 
echo "<p style=\"margin:15px;\"><b>Successfully registered! You will be redirected to the login page in 3 seconds where you can login.</b></p>";
?>
<script>
window.setTimeout(function(){
location.href = "https://localhost/CW/Tech_Talk/index.php/login";
}, 3000);
</script>
</div>
