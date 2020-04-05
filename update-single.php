<?php

require "./config.php";
require "./common.php";

if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $marker =[
      "id"        => $_POST['id'],
      "name" => $_POST['name'],
      "latitude"  => $_POST['latitude'],
      "longitude"     => $_POST['longitude'],
      "desription"       => $_POST['description'],
      "added"  => $_POST['added'],
      "edited"      => $_POST['edited']
    ];

    $sql = "UPDATE markers.markers
            SET id = :id,
              name = :name,
              latitude = :latitude,
              longitude = :longitude,
              description = :description,
              added = :added,
              edited = :edited
            WHERE id = :id";

  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET['id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];
    $sql = "SELECT * FROM markers.markers WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php if (isset($_POST['submit']) && $statement) : ?>
  <?php echo escape($_POST['name']); ?> successfully updated.
<?php endif; ?>

<h2>Muuda marker</h2>

<form method="post">
    <?php foreach ($user as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>