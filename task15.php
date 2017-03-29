<?php
  $pdo = new PDO("mysql:host=localhost; dbname=task13;charset=utf8", "root", "");
  $sql = " CREATE TABLE cars (`id` int(11) NOT NULL AUTO_INCREMENT, `type` varchar(20) NOT NULL, `color` varchar(20) NOT NULL, `price` varchar(20) NOT NULL,  `hp` INT NOT NULL,PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;)";
  $pdo->query($sql);


  $tables_sql =" SHOW TABLES";
?>
<ul>
<?php
  foreach ($pdo->query($tables_sql) as $row) {
    echo "<li><a href='/task15_table.php?table=".$row['Tables_in_task13']."'>".$row['Tables_in_task13']."</a></li>";
  }
?>
</ul>
