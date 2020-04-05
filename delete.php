<?php

require "./config.php";
require "./common.php";

if (isset($_GET["id"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $id = $_GET["id"];

        $sql = "DELETE FROM markers.markers WHERE id = :id";
            
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
            
        $success = "Marker edukalt kustutatud";
  } catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
  }
}

try {
    $connection = new PDO($dsn, $username, $password, $options);
  
    $sql = "SELECT * FROM markers.markers";
  
    $statement = $connection->prepare($sql);
    $statement->execute();
  
    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
?>

<?php require "templates/header.php";?>

<h2>Kustuta markerid</h2>

<table>
    <thead>
        <tr>
            <th>Nr</th>
            <th>Nimi</th>
            <th>Pikkuskraad</th>
            <th>Laiuskraad</th>
            <th>Kirjeldus</th>
            <th>Lisatud</th>
            <th>Kustutatud</th>
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
          <td><a href="delete.php?id=<?php echo escape($row["id"]); ?>">Kustuta</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
  
<a href="index.php">Tagasi algusesse</a>
<?php require "templates/footer.php";?>