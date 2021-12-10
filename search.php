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

     <?php 
        if(isset($_GET['tag'])) {
            include('load_info.php');
        if (isset($_SESSION['login'])){
            ?>
            <div class='tasks'>
            <?php
                $sql = 'SELECT * FROM task WHERE tags LIKE "%'.$_GET['tag'].'%" ORDER BY task.name ASC';
                $result = mysqli_query($mysqli, $sql); 
                while ($row = mysqli_fetch_array($result)) {
                    loadTask("","", $row, $row['id']);
                }
            ?>
            </div>
            <?php
        }
        else {
            ?>
            <div class='needLog'><p class='needT'>Щоб вирішувати задачі потрібно авторизуватись!</p>
                <form action='login.php'><button class='tb' type='submit'>Авторизація</button></form>
                <p class='needT'>Якщо у вас немає облікового запису, зареєструйтесь.</p>
                <form action='registration.php'><button class='tb' type='submit'>Реєстрація</button></form>
            </div>
      <?php  }
        }
        if (isset($_GET['search'])) {
            include('load_info.php');
            echo "<div class='news'>";
            $sql = 'SELECT test_id as id,date,type, name as name, test_themes_id as text FROM test WHERE name LIKE "%'.$_GET['search'].'%" UNION SELECT theme_id as id,date,type, theme_name as name, text as text FROM theory_themes WHERE theme_name LIKE "%'.$_GET['search'].'%" OR text LIKE "%'.$_GET['search'].'%" UNION SELECT id,date,type, name, details as text FROM task WHERE name LIKE "%'.$_GET['search'].'%" OR details LIKE "%'.$_GET['search'].'%" ORDER BY id DESC';
            $result = mysqli_query($mysqli, $sql); 
            $rowcount=mysqli_num_rows($result);
            if($rowcount == 0){
                echo "<div style='font-size:18px;' class='new'>Нічого не знайдено!</div>";
            } 
            while ($row = mysqli_fetch_array($result)) {
                if ($row['type'] == 1) {
                    $sql = 'SELECT sections.*, theory_themes.* FROM sections, theory_themes WHERE sections.id = theory_themes.section_id AND theory_themes.date = "'.$row['date'].'"  LIMIT 10';
                    $res = mysqli_query($mysqli, $sql);
                    while ($arr = mysqli_fetch_array($res)) {
                        loadTheory("","",$arr);
                    }
                }
            if ($row['type'] == 2) { 
                $sql = 'SELECT test.* FROM  test WHERE test.date = "'.$row['date'].'"';
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
                    loadTest("","",$themes, $arr, $arr['test_id']);
                }   
            }
            if ($row['type'] == 3) {
                $sql = 'SELECT * FROM task WHERE date = "'.$row['date'].'"';
                $res = mysqli_query($mysqli, $sql);
                while ($arr = mysqli_fetch_array($res)) {
                    loadTask("","", $arr, $row['id']);
                }
            }
            }
        }
    ?>
    
</body>
</html>