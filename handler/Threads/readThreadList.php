<?php
include 'partials/_dbConnect.php';
doDB();
$conn = mysqli_connect("localhost", "root", "", "user007");

$xmlList = simplexml_load_file("threads.xml") or die(header("Location: threadList.php"));

$display_block = "<table>";
$display_block.="<tr><th>Id</th><th>Topic Title</th><th>Date Created</th><th>Owner</th><th>Likes</th></tr>";

foreach($xmlList->topic as $t){
    $id = $t->id;
    $title = $t->title;
    $created = $t->created;
    $owner = $t->owner;
    $likes = $t->likes;

    $safe_id = mysqli_escape_string($conn, $id);
    $safe_title = mysqli_escape_string($conn, $title);
    $safe_created = mysqli_escape_string($conn, $created);
    $safe_owner = mysqli_escape_string($conn, $owner);
    $safe_likes = mysqli_escape_string($conn, $likes);

    $display_block .= "<tr><td>".$safe_id."</td><td>".$safe_title."</td><td>".$safe_created."</td><td>".$safe_owner."</td><td>".$safe_likes."</td></tr>";
}
$display_block .= "</table>";

//close connection to MySQL
mysqli_close($conn);


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Read Saved File</title>
    <link rel = "stylesheet" href = "/html_css/css/threads.css">
    <style>
        table {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th {
            border: 1px solid black;
            padding: 6px;
            font-weight: bold;
            background: #2770e5;
            color: white;
        }
        td {
            border: 1px solid black;
            padding: 6px;
        }
        .num_posts_col { text-align: center; }
        #logOut{
            background-color: #4286f4;
            color: white;
            position: fixed;
            top: 15px;
            right: 15px;
            padding: 5px 20px;
            border: 1px solid white;
            border-radius: 20px;
        }
        #logOut:hover{
            background-color: white;
            color: #4286f4;
        }
    </style>
</head>
<body>
<header id = "top">
    <h1> UniForum Thraeds </h1>
</header>
<nav>
    <a href = "/html_css/html/home.html"><button>Main Menu</button></a>
    <a href="/handler/Threads/showThread.php"><button>Show Threads</button></a>
    <a href = "/html_css/html/addThread.html"><button>Add Threads</button></a>
</nav>

<main>
    <section id = "filler"> </section>
    <section id = "saved">
        <p>Saved Topics:</p>

        <?php echo $display_block; ?>
    </section>
    <section id = "filler"> </section>

    <a href = "/Initial/logout.php"><button id = "logOut">Logout</button></a>
</main>
</body>
</html>