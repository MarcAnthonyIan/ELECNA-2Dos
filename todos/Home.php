<?php
session_start();
if (isset($_SESSION["user"])) {
    require_once "db_conn.php";


    // Keep the database connection open
    $conn = new mysqli($sName, $uName, $pass, $db_name);


    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query the user's tasks table
    $sql = "SELECT * FROM todos ORDER BY date_time DESC";
    $result = $conn->query($sql);
} else {
    header("Location: register.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>2Do's</title>
    <link rel="stylesheet" href="styles/newstyles.css">
    <link rel="stylesheet" href="styles/styles.css">

</head>

<body>


    <div id="sidebar">
        <div class="sidebar-item" id="user-account">
            <div id="user-info">
                <img src="assets/user.png" alt="User" id="user-image">
                <span id="userName"> <?php echo $_SESSION['username']; ?> </span>
                <span id="user-email"> <?php echo $_SESSION['email']; ?> </span>
                <a href="logout.php">
                    <div id="logout"> logout </div>

                </a>
            </div>
        </div>
        <span class="line"></span>
        <a href="Home.php">
            <div class="sidebar-item" id="Home">Home</div>
        </a>
        <a href="task.php">
            <div class="sidebar-item" id="Task">Task</div>
        </a>
        <a href="about.php">
            <div class="sidebar-item" id="Create a task">About</div>
        </a>
        <span class="line"></span>
        <a href="Premium.php">
            <div class="sidebar-item" id="Create a task">PREMIUM <i class="fa-solid fa-crown"></i></div>
        </a>

        </main>
    </div>
    </div>

    <section class="hero">
        <img class="asset" src="assets/homepage.gif" alt="" srcset="">
        <h1 class="welcome">Welcome to 2Do's</h1>
        <p> Stay focused, stay organized, and stay on top of your goals with our intuitive interface. Start achieving more today!</p>
        <button class="button" onclick="document.location='task.php'">Get Started</button>
    </section>

    <script>
        function myFunction() {
            var x = document.getElementById("form");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>

    <script src="scripts/jquery-3.2.1.min.js"></script>
    <script src="scripts/script.js"></script>
    <script>
        $(document).ready(function() {
            $('.remove-to-do').click(function() {
                const id = $(this).attr('id');
                $.post("remove.php", {
                        id: id
                    },
                    (data) => {

                        if (data) {
                            $(this).parent().hide(600);
                        }
                    }
                )
            });
            $(".check-box").click(function(e) {
                const id = $(this).attr('data-todo-id');
                const checked = $(this).prop('checked') ? 1 : 0;

                $.post("check.php", {
                    id: id,
                    checked: checked
                }, function(data) {
                    if (data != 'error') {
                        const h2 = $(this).next();
                        if (data === '1') {
                            h2.removeClass('checked');
                        } else {
                            h2.addClass('checked');
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>