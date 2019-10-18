<?php
require "connection.php";

if (empty($_GET)) {
    $_GET['user'] = 1;
}
$sql = "SELECT * FROM students WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id'=> $_GET['user']]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

if ($_SESSION['id'] = $_GET['user']) {
    echo "editable";
    $edit = true;
}
?>
<form action="profile.php" method="post">
    <select name="options">
        <option value="edit">Edit</option>
        <option value="delete">Delete</option>
    </select>
    <input type="submit">
</form>

<?php
 if (isset($_POST["options"]) == 'edit') {
     if ($_SESSION['id'] = $_GET['user'] && $edit = true) {
         $url = "/profileEdit.php?user=". $_SESSION['id'];
         header("location: ". $url);
         exit;
     }

 }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php
            echo $data['first_name'];
            echo " ";
            echo $data['last_name'];
        ?>
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="./profile.php">Individual Profiles<span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="register.php">Add New Student<span class="sr-only">(current)</span></a>
            </div>
        </div>
    </nav>
</header>
<main class="container-fluid ">
    <section class="row py-5 bg-dark">
        <div class="col-6">
            <img class=" border border-info rounded-circle rounded mx-auto d-block" src="<?php echo $data['avatar']?>" alt="">
        </div>
        <div class="col-6 d-flex align-items-end">
            <h1 class="text-light pt-3"><?php
                echo $data['first_name'];
                echo " ";
                echo $data['last_name'];
                echo '<hr>';
                ?></h1>
            <h3 class="  text-light pt-3"><?php
                echo '<br>';
                echo $data["username"] ?></h3>
        </div>

    </section>
    <section class="row bg-light py-3">
        <h3 class="col-4 text-center">
            <a href="<?php echo $data['github']?>">Github Page</a>
        </h3>
        <h3 class="col-4 text-center">
            <a href="<?php echo $data['linkedin']?>">Linkedin Page</a>
        </h3>
       <h3 class="col-4 text-center">
           <a href="<?php echo $data['email']?>">Email</a>
       </h3>

    </section>
    <section class="row bg-light">
        <div class="col-2"></div>
        <div class="col-4 mt-5">
            <h4 >Preferred Language: <?php echo $data['preferred_language'] ?></h4>
            <h3 ><?php echo $data['quote'] ?></h3>
            <h6 ><?php echo $data['quote_author'] ?></h6>
            <h6 >Memeber since: <?php
                $date = $data["created_at"];
                $date = strtotime($date);
                echo date('M Y', $date);
                ?></h6>
        </div>

        <iframe class="col-4" width="420" height="315" src="<?php echo $data['video']?>controls=0"></iframe>
        <div class="col-2"></div>
    </section>
    <section>

    </section>
</main>
</body>
</html>


