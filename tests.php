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
        if (isset($_SESSION['login'])){
            include("load_info.php");
             ?>
             <div class='tests-name'>
            <?php
                $sql = 'SELECT test.* FROM  test ORDER BY test.name ASC';
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
                    loadTest("Тести ","'",$themes, $arr, $arr['test_id']);
                    }
            ?>
            </div>
            <?php
        }
        else {
            ?>
            <div class='needLog'><p class='needT'>Щоб проходити тести потрібно авторизуватись!</p>
                <form action='login.php'><button class='tb' type='submit'>Авторизація</button></form>
                <p class='needT'>Якщо у вас немає облікового запису, зареєструйтесь.</p>
                <form action='registration.php'><button class='tb' type='submit'>Реєстрація</button></form>
            </div>
      <?php  }

    ?>
    
</body>
</html>
