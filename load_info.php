<?php
function loadTheory ($s,$ch,$arr) {
    $str = mb_strimwidth($arr['text'], 0, 100, "...");
    echo "
    <div class='new'>
    <h3 class='sname'>".$s.$arr['theme_name'].$ch."</h3>
    <label class='date_l'>Дата створення: ".$arr['date']."</label> <br>
    <div class='text'>".$str."</div> 
    <form class='textform' action='theory_theme.php' method='get'>
    <button class='read' name='theme' value='".$arr['theme_name']."'>Читати далі</button>
    </form>
    </div>";
}
function loadTest($stri,$ch,$themes, $arr, $id){
    echo "
    <div class='new'>
    <h3>".$stri.$ch.$arr['name'].$ch."</h3>
    <label class='date_l'>Дата створення: ".$arr['date']."</label> <br>
    <label class='new_t'>Теми тестів: ".$themes."</label> <br>
    <form class='testform' action='about_test.php' method='get'>";
    if (isset($_SESSION['login'])) {
        echo "<button class='tests' name='testid' value='".$id."'>Перейти до тесту</button>"; //$arr['test_id']
    }
    else {
        echo " <button class='testsd' disabled='disabled' name='".$id."' title='Для проходження тестів потрібно зареєструватись!' >Перейти до тесту</button>";
    }
    echo "
    </form>
    </div>";
}
function loadTask($str,$ch, $arr, $id){
    echo "
    <div class='new'>
    <h3>".$str.$ch.$arr['name'].$ch."</h3>
    <label class='date_l'>Дата створення: ".$arr['date']."</label> <br>";
    $tags = explode(",", $arr['tags']);
    echo "<div class='tags'>";
    foreach ($tags as $tag) {
    echo "
    <a class='tag' href='search.php?tag=".urlencode($tag)."'>".$tag."</a>";
    }
    echo "</div><form class='textform' action='task_info.php' method='get'>";
    if (isset($_SESSION['login'])) {
    //echo " <button class='taskbutton' name='taskid' value='".$row['id']."'>Перейти до задачі</button>";
    echo " <button class='taskbutton' name='taskid' value='".$id."'>Перейти до задачі</button>";
    }
    else {
    echo " <button class='taskbuttond' disabled='disabled'  name='taskid' value='".$id."' title='Для проходження задач потрібно зареєструватись!' >Перейти до задачі</button>";
    }
    echo "</form>
    </div>";
}
?>