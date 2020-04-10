<?php

if (isset($_POST['submit'])) {
  try {
    require "./config.php";
    require "./common.php";

    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT *
    FROM markers.markers
    WHERE name = :name";
    
    $name = $_POST['name'];
    
    $statement = $connection->prepare($sql);
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->execute();
    
    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>

 
      <h2>Markerid</h2>

      <table>
        <thead>
  <tr>
    <th>#</th>
    <th>Nimi</th>
    <th>Pikkuskraad</th>
    <th>Laiuskraad</th>
    <th>Kirjeldus</th>
    <th>Lisatud kuupäev</th>
    <th>Muudetud kuupäev</th>
  </tr>
        </thead>
        <tbody>
    <?php foreach ($result as $row) { ?>
        <tr>
          <td><?php echo escape($row["id"]); ?></td>
          <td><?php echo escape($row["name"]); ?></td>
          <td><?php echo escape($row["latitude"]); ?></td>
          <td><?php echo escape($row["longitude"]); ?></td>
          <td><?php echo escape($row["description"]); ?></td>
          <td><?php echo escape($row["added"]); ?></td>
          <td><?php echo escape($row["edited"]); ?> </td>
        </tr>
      <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
      > No results found for <?php echo escape($_POST['name']); ?>.
    <?php }
  } ?>
<div class="formarea ml-3" > 
  <h2>Leia marker</h2>

  <form method="post">
    <label for="name">Nimetus:</label>
    <input type="text" id="name" name="name">
    <input type="submit" name="submit" value="Kuva tulemus">
  </form>
  <br>
  <a href="index.php">Tagasi algusesse</a>
</div>
<?php require "templates/footer.php";?>