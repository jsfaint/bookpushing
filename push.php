<!DOCTYPE html>
<html>
  <head>
    <?php include("common.inc"); ?>
    <meta charset="UTF-8">
  </head>

  <body>
<script type="text/javascript">
function check() {
    var email = this.document.getElementById('email_name').value;
    if (email == "") {
        alert("Please input email name(without domain name)");
        return false;
    }
}
</script>

<title>Book Push Engine</title>
<?php
$filename = $book_dir . _get("name");
echo '<p>';
echo 'File Name: ';
echo empty($filename) ? "" : str_replace($http_base, "", $filename);
echo '</p>';
?>

<?php
$email = _post("email_name");

if (filesize($filename) >= 20*1024*1024) { //attachment size is limited to 20MB
    echo 'File is too big, please <a href="http://' . $_SERVER['SERVER_NAME'] .  str_replace($http_base, "", $filename) . '">download</a> it directly.</br>';
    echo 'Back to ' . '<a href="./index.php">Search</a>' . ' page';
} else {
    echo '<form id="email_push" method="POST" action="" onsubmit="check(this)">';
    echo 'Please input your email:</br>';
    echo '<input name="email_name" id="email_name">@';
    echo '<select name="email_domain">';
    echo '<option>iduokan.com</option>';
    echo '<option>free.kindle.com</option>';
    echo '<option>kindle.com</option>';
    echo '<option>free.kindle.cn</option>';
    echo '</select>';
    echo '<input type="submit"><br/>';
    echo '<font color=red>For Non-Duokan user:<br/>Please add "@gmail.com" to your Amazon <b>"Approved Personal Document E-mail List"</b></font></br>';
    echo '</form>';
}

if ($email != null) {
    $email = $email . "@" . _post("email_domain");

    `python3 ./sendmail.py $email "$filename" &`;
    echo '<strong>Sending complete</strong></br>';
    echo "</br>";

    echo 'Back to ' . '<a href="./index.php">Search</a>' . ' page';
}
?>
</body>
</html>
