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
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" type="text/css" href="styles/aboutstyle.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
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
            <div class="sidebar-item" id="Create a task">Task</div>
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

    <div class="about-content">
        <span class="about-span"> 2Do's</span>

        <div class="container">
            <div class="row">
                <div class="column">
                    <img src="assets/1.png" alt="">
                    <p>At our core, we are passionate about helping you conquer your tasks, goals, and ambitions with ease and efficiency. Whether you're a seasoned multitasker or a newcomer to the world of task management, our platform is designed to streamline your workflow and bring clarity to your day.</p>
                </div>
                <div class="column">
                    <img src="assets/2.png" alt="">
                    <p>Here, you'll find a sleek and intuitive interface that empowers you to create, prioritize, and manage your tasks effortlessly. From daily errands to long-term projects, our robust features ensure that no task is forgotten and no deadline is missed</p>
                </div>
                <div class="column">
                    <img src="assets/3.png" alt="">
                    <p>But we're more than just a tool for ticking off items on your to-do list. We're a community of individuals committed to personal growth and success. Through insightful tips, motivational content, and collaborative features, we aim to inspire and support you on your journey to productivity mastery.</p>
                </div>
            </div>
        </div>
    </div>


    <footer class="footer">


        <img src=" " alt="">
        <div class="container">
            <div class="row">

                <div class="footer-col">
                    <h4>Get help</h4>
                    <ul>
                        <li>
                            <p>2dos@gmail.com</p>
                        </li>
                        <li>
                            <p>+123-456-7890</p>
                        </li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </div>

</body>

</html>