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
             <div class='tasks'>
            <?php
                $sql = 'SELECT * FROM task ORDER BY task.name ASC';
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

    ?>

</body>
</html>
