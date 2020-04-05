<?php

if(isset($_POST['submit'])){
    require "./config.php";
    require "./common.php";

    try{
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_marker =array(
            "name" => $_POST['name'],
            "latitude" => $_POST['latitude'],
            "longitude" => $_POST['longitude'],
            "description" => $_POST['description']
        );
        $sql = sprintf(
    "INSERT INTO %s (%s) values (%s)",
    "markers.markers",
    implode(", ", array_keys($new_marker)),
    ":" . implode(", :", array_keys($new_marker))
        );
        $statement = $connection->prepare($sql);
        $statement->execute($new_marker);

        } catch(PDOException $error) {
        echo $sql ."<br>" . $error->getMessage();
    }
}
?>
<?php require "templates/header.php";?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  <?php echo escape($_POST['name']); ?> successfully added.
<?php } ?> 

<h2>Lisa marker</h2>

<form method="POST">
    <label for="name">Nimetus</label>
    <input type="text" name="name" id="name">
    <label for="latitude">Laiuskraad</label>
    <input type="text" name="latitude" id="latitude">
    <label for="name">Pikkuskraad</label>
    <input type="text" name="longitude" id="longitude">
    <label for="name">Kirjeldus</label>
    <input type="text" name="description" id="description">
    <label for="name">Lisatud</label>
    <input type="text" name="added" id="added">
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Tagasi algusesse</a>

<?php require "templates/footer.php";?>

