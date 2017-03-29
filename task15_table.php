<?php
  $pdo = new PDO("mysql:host=localhost; dbname=task13;charset=utf8", "root", "");
  if ($_POST['name']) {
    $get_type_sql = "select DATA_TYPE,CHARACTER_MAXIMUM_LENGTH from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME = '".$_GET['table']."' and COLUMN_NAME = '".$_POST['column']."';";
    $columnInfo = $pdo->query($get_type_sql)->fetch();
    $defaultType = $columnInfo['DATA_TYPE']."(".$columnInfo['CHARACTER_MAXIMUM_LENGTH'].")";
    if ($_POST['type']) {
      $defaultType = $_POST['type'];
    }
    $change_sql = "ALTER TABLE ".$_GET['table']." CHANGE COLUMN ".$_POST['column']." ".$_POST['name']." ".$defaultType." NOT NULL";
    $pdo->query($change_sql);
  }
  if ($_GET['action']=='remove') {
    $remove_sql = "ALTER TABLE ".$_GET['table']." DROP COLUMN ".$_GET['column']." ";
    $pdo->query($remove_sql);
  }
  $sql =" DESCRIBE ".$_GET['table'].";";
?>
<table>
  <thead>
<?php
  foreach ($pdo->query($sql) as $row) {
    echo "<th><div>".$row['Field']."</div><div>".$row['Type']."</div><div><a href='/task15_table.php?table=".$_GET['table']."&action=remove&column=".$row['Field']."'>Удалить</a></div></th>";
  }
?>
</thead>
</table>

<form method="POST" action="">
  <select name="column">
    <?php
      foreach ($pdo->query($sql) as $row) {
        echo "<option value='".$row['Field']."'>".$row['Field']."</option>";
      }
    ?>
  </select>
  <input type="text" name="name" />
  <input type="text" name="type" />
  <button>apply</button>
</form>
