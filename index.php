<html>
<head>
<meta charset="utf-8">
 <link rel="stylesheet" href="css/index.css">
 <link rel="stylesheet" href="css/font-awesome.css">
</head>
<body>


<?php
include('header.php');
?>

<div class='news'>

<?php
 
require_once("dbconnect.php");
include('load_info.php');

$sql = 'SELECT date,type, `test_themes_id` FROM `test` 
        UNION SELECT date,type, theme_name FROM theory_themes  
        UNION SELECT date,type, name FROM task  
        ORDER BY date DESC LIMIT 10';

$result = mysqli_query($mysqli, $sql);
while ($row = mysqli_fetch_array($result)) {
    if ($row['type'] == 1) {
        $sql = 'SELECT sections.*, theory_themes.* FROM sections, theory_themes WHERE sections.id = theory_themes.section_id AND theory_themes.date = "'.$row['date'].'"  LIMIT 10';
        $res = mysqli_query($mysqli, $sql);
        while ($arr = mysqli_fetch_array($res)) {
            loadTheory("Новий запис у розділі ","!",$arr);
        }
    }
     if ($row['type'] == 2) {
        $sql = 'SELECT  test.* FROM  test WHERE test.date = "'.$row['date'].'"  LIMIT 10';
        $res = mysqli_query($mysqli, $sql);

        while ($arr = mysqli_fetch_array($res)) {
            $str = explode(",", $arr['test_themes_id']);
            $themes = "";
            for ($i = 0; $i < count($str); $i++) {
                $sql = 'SELECT theme_id, theme_name FROM theory_themes WHERE theme_id = '.$str[$i];
                $t = mysqli_query($mysqli, $sql);
                while ($a = mysqli_fetch_array($t)){
                    $themes .= $a['theme_name'].", ";
                }
            }
            $themes = substr($themes,0,-2);
            loadTest("Нові тести ","'",$themes, $arr, $arr['test_id']);
        }   
    }
     if ($row['type'] == 3) {
        $sql = 'SELECT * FROM task WHERE date = "'.$row['date'].'"  LIMIT 10';
        $res = mysqli_query($mysqli, $sql);
        while ($arr = mysqli_fetch_array($res)) {
            loadTask("Нова задача ","'", $arr, $arr['id']);
        }
    }
}

?>

</div>

</body>
</html>

