<!DOCTYPE html>
<html>
  <title>Books Search Engine</title>

  <head>
    <meta charset="UTF-8">
  </head>

<body>
  <h1>A simple book search and push engine</h1>
  <p><a href="list.php" target="_blank">Here is a Book list, FYR~</a></p>
  <form method="POST" action="" >
    <input type="search" name="search_value">
    <input type="submit">
  </form>

  <br/>

<?php
include("common.inc");

function search($dir, $key)
{
    global $http_base, $book_dir;
    $list = array();
    $list[] = $dir;
    $row = 0;

    while (count($list) > 0)
    {
        $file = array_pop($list);

        if (is_dir($file))
        {
            $children = scandir($file);
            foreach ($children as $child)
            {
                if ($child !== '.' && $child !== '..')
                {
                    $list[] = $file.'/'.$child;
                }
            }
        } else if (stripos($file, $key) != false) {
            if ($row%2==0) {
                echo '<tr bgcolor="lavender"><td>' . str_replace($book_dir, "", $file) . '</td>';
            } else{
                echo '<tr bgcolor="white"><td>' . str_replace($book_dir, "", $file) . '</td>';
            }
            echo '<td><a href="./push.php?name=' . str_replace($book_dir, "", $file) . '">Push to Kindle</a></td>';
            echo '<td><a href="http://' . $_SERVER['SERVER_NAME'] . str_replace($http_base, "", $file) . '">Download</a></td></tr>';

            $row = $row +1;
        }
    }
}

$search_path = $book_dir;
$key = _post('search_value');

if ($key != null) {
    echo "<table>";
    echo '<th align="left">Search Result:</th>';
    search("$search_path", "$key");
    echo "</table>";
}
?>

</body>
</html>
