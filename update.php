<?php

if (isset($_POST['submit'])) {
  try {
    require "./config.php";
    require "./common.php";

    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT * FROM markers.markers";
 
    $statement = $connection->prepare($sql);
    $statement->execute();
    
    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>

<h2>Markerid</h2>

<table>
    <thead>
        <tr>
            <th>Nr</th>
            <th>Nimi</th>
            <th>Pikkuskraad</th>
            <th>Laiuskraad</th>
            <th>Kirjeldus</th>
            <th>Lisatud kuupäev</th>
            <th>Muudetud kuupäev</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php echo escape($row["id"]); ?></td>
            <td><?php echo escape($row["name"]); ?></td>
            <td><?php echo escape($row["latitude"]); ?></td>
            <td><?php echo escape($row["longitude"]); ?></td>
            <td><?php echo escape($row["description"]); ?></td>
            <td><?php echo escape($row["added"]); ?></td>
            <td><a href="update-single.php?id=<?php echo escape($row["id"]); ?>">Muuda</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
  
<a href="index.php">Tagasi algusesse</a>