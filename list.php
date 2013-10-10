<!DOCTYPE html>
<html>
<title>Book List</title>
<head>
    <meta charset="UTF-8">
</head>
<body>

<table class='db'>
<th align="left">Book List</th>

<?php
include("common.inc");

function book_list($dir)
{
    global $book_dir;
    $row = 0;

    $list = array();
    $list[] = $dir;

    while (count($list) > 0)
    {
        $file = array_pop($list);

        if ($row%2==0) {
            echo "<tr bgcolor='lavender'>";
        } else {
            echo "<tr bgcolor='white'>";
        }
        $row = $row + 1;

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
            echo "<td>" . str_replace($book_dir, "", $file) . "</td>";
        } else if (is_file($file)) {
            echo "<td> + " . $file .  "</td>";
            echo '<td><a href="./push.php?name=' . str_replace($book_dir, "", $file) . '">Push to Kindle</a></td>';
        }
        echo "</tr>";
    }
}

$path = $book_dir;
book_list("$path");
?>
</body>
</html>
