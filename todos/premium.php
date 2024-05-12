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
    <link rel="stylesheet" href="styles/premstyles.css">

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

    <div class="container">
        <div class="card">
            <h2>Unlock Your Productivity Potential with 2Do's Premium!</h2>
            <p> Introducing 2Do's Premium – your ultimate toolkit for seamless organization and unmatched efficiency. With exclusive access to advanced features, prioritize your tasks, stay focused, and achieve your goals like never before.</p>
            <h4>Why Upgrade to 2Do's Premium?</h4>
            <ul>
                <li>TASK TRACKER</li>
                <li>CUSTOMIZABLE THEMES</li>
                <li>ADVANCE REMINDERS</li>
            </ul>

            <p>Upgrade to 2Do's Premium today and unlock the full potential of your to-do list. Experience unparalleled organization, seamless collaboration, and unmatched support, empowering you to conquer your goals with confidence.</p>
            <form id="thanks" method="POST">
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
                <button type="submit">
                    Subscribe
                </button>
            </form>

            <p class="msg" id="congo">
                Thanks for subscribing!
            </p>
        </div>
    </div>

    <script>
        const form = document.getElementById("thanks");
        const successMessage =
            document.getElementById("congo");

        form.addEventListener("submit", function(e) {
            e.preventDefault();
            successMessage.style.display = "block";
        });
    </script>
</body>

</html>