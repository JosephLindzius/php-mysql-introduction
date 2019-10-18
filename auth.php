<?php

require "connection.php";


if ($_SERVER['REQUEST_URI'] == "/index.php") {
    $sql = "SELECT * FROM students";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


if ($_SERVER['REQUEST_URI'] == "/login.php") {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {



        $password = $_POST["password"];
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "SELECT password, id FROM students WHERE username=:username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([ 'username' => $_POST["username"]]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

        if (password_verify($data['password'], $hashPassword)) {
            unset($_POST);
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $data["id"];
            $url = "/profile.php?user=". $data["id"];
            header("location: ". $url);
            exit;
        }

    }

}

if ($_SERVER['REQUEST_URI'] == "/register.php") {
    $emailErr = "";
    $checker = false;
    $passwordMatch = false;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $required = array("first_name", "last_name", "username", "linkedin", "github", "email", "preferred_language", "avatar", "video", "quote", "quote_author");


        foreach($required as $field) {
            if (empty($_POST[$field])) {
                $error = true;
            } else {
                $_SESSION['postdata'] = $_POST[$field];
            }
            if (htmlspecialchars( "$_POST[$field]")) {
                $charErr = "$_POST[$field] has used special characters";
            }
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "$_POST[email] is NOT a valid email address";
        }

        $error = false;
        if ($error) {
            echo "<span class='alert-danger'>All fields are required.</span><br>";
        } else {
            $checker = true;
        }

        if ($_POST['password'] === $_POST['passwordConfirm']) {
            $passwordMatch = true;
        } else {
            echo "<span class='alert-danger'>Password fields do not match!</span><br>";
        }

    }


    if ($_SERVER['REQUEST_METHOD'] == "POST" && $checker == true && $passwordMatch == true) {

        $sql = "INSERT INTO students (first_name, last_name, username, linkedin, github, email, preferred_language, avatar, video, quote, quote_author, password) VALUES (:first_name, :last_name, :username, :linkedin, :github, :email, :preferred_language, :avatar, :video, :quote, :quote_author, :password)";

        if ($pdo->prepare($sql)) {

            $stmt = $pdo->prepare($sql);

            $firstName = $_POST["first_name"];
            $lastName = $_POST["last_name"];
            $username = $_POST["username"];
            $linkedin = $_POST["linkedin"];
            $github = $_POST["github"];
            $email = $_POST["email"];
            $preferredLanguage = $_POST["preferred_language"];
            $avatar = $_POST["avatar"];
            $video = $_POST["video"];
            $quote = $_POST["quote"];
            $quote_author = $_POST["quote_author"];
            $password = $_POST["password"];
            $password = password_hash($password, PASSWORD_DEFAULT);

            $stmt->bindParam(':first_name', $firstName);
            $stmt->bindParam(':last_name', $lastName);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':linkedin', $linkedin);
            $stmt->bindParam(':github', $github);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':preferred_language',$preferredLanguage);
            $stmt->bindParam(':avatar', $avatar);
            $stmt->bindParam(':video', $video);
            $stmt->bindParam(':quote', $quote);
            $stmt->bindParam(':quote_author', $quote_author);
            $stmt->bindParam(':password', $password);

            if($stmt->execute()) {
                echo "added";
                $query = "SELECT id FROM students WHERE username=:username";

                $userID = selectWHere($pdo, $query,'username', $_POST['username']);
                $_SESSION["userID"] = $userID['id'];
                unset($_POST);
                unset($_SESSION["postdata"]);
                $url = "/profile.php?user=". $userID['id'];
                header("location: ". $url);
                exit;
            }

        }

    }
}

