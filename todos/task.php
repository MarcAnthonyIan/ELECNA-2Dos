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

    <div class="main-section">
        <div class="main">
            <button id="open-form-button" onclick="myFunction()">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path>
                    </svg>
                </span>
            </button>



            <div class="add-section" id="form" style="display: none;">
                <form action="add.php" method="POST" autocomplete="off">
                    <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
                        <input type="text" name="title" style="border-color: #000" placeholder="This Field is required">

                        <label class="form-control">
                            <i class="fa-solid fa-user"></i>
                            <input type="radio" name="category" value="PERSONAL" />

                        </label>

                        <label class="form-control">
                            <i class="fa-solid fa-book"></i>
                            <input type="radio" name="category" value="SCHOOL" checked />

                        </label>
                        <label class="form-control">
                            <i class="fa-solid fa-suitcase"></i>
                            <input type="radio" name="category" value="OFFICES" checked />

                        </label>
                        <label class="form-control">
                            <i class="fa-solid fa-house"></i>
                            <input type="radio" name="category" value="HOUSE" />

                        </label>
                        <!-- =================================================================-->
                        <button type="submit">Add &nbsp; <span>&#43;</span></button>
                    <?php } else { ?>
                        <input type="text" name="title" placeholder="What do you need to do?">

                        <label class="form-control">
                            <i class="fa-solid fa-user" id="icon"></i>
                            <input type="radio" name="category" value="PERSONAL" />

                        </label>

                        <label class="form-control">
                            <i class="fa-solid fa-book"></i>
                            <input type="radio" name="category" value="SCHOOL" checked />

                        </label>

                        <label class="form-control">
                            <i class="fa-solid fa-suitcase"></i>
                            <input type="radio" name="category" value="OFFICES" checked />

                        </label>
                        <label class="form-control">
                            <i class="fa-solid fa-house"></i>
                            <input type="radio" name="category" value="HOUSE" />

                        </label>


                        <button type="submit">Add &nbsp; <span>&#43;</span></button>
                    <?php } ?>
                </form>
            </div>
        </div>

        <?php
        $todos = $conn->query("SELECT * FROM todos ORDER BY ID DESC")
        ?>
        <div class="show-todo-section">
            <?php if ($todos->num_rows <= 0) { ?>
                <div class="todo-item">
                    <div class="empty">
                        <img src="assets/f.png" width="100%">
                        <img src="assets/Ellipsis.gif" width="80px">
                    </div>
                </div>
            <?php } ?>



            <?php
            while ($todo = $result->fetch_assoc()) { ?>

                <div class="todo-item">
                    <?php if ($todo['checked']) { ?>
                        <span id="<?php echo $todo['id'] ?>" class="remove-to-do">x</span>
                        <input type="checkbox" data-todo-id="<?php echo $todo['id']; ?>" class="check-box" checked />
                        <?php if ($todo['category'] == 'PERSONAL') : ?>
                            <i class="fa-solid fa-user" style="color: gray;"></i>
                        <?php elseif ($todo['category'] == 'SCHOOL') : ?>
                            <i class="fa-solid fa-book" style="color: gray;"></i>
                        <?php elseif ($todo['category'] == 'OFFICES') : ?>
                            <i class="fa-solid fa-suitcase" style="color: gray;"></i>
                        <?php elseif ($todo['category'] == 'HOUSE') : ?>
                            <i class="fa-solid fa-house" style="color: gray;"></i>
                        <?php endif; ?>
                        <input type="text" value="<?php echo $todo['title'] ?>" id="title_task_<?php echo $todo['id']; ?>" name="title" onchange="updateData(<?php echo $todo['id']; ?>)" class="title_task" style="text-decoration:line-through;  color:#999 !important" />


                    <?php } else { ?>
                        <span id="<?php echo $todo['id'] ?>" class="remove-to-do">x</span>
                        <input type="checkbox" data-todo-id="<?php echo $todo['id']; ?>" class="check-box">
                        <?php if ($todo['category'] == 'PERSONAL') : ?>
                            <i class="fa-solid fa-user"></i>
                        <?php elseif ($todo['category'] == 'SCHOOL') : ?>
                            <i class="fa-solid fa-book"></i>
                        <?php elseif ($todo['category'] == 'OFFICES') : ?>
                            <i class="fa-solid fa-suitcase"></i>
                        <?php elseif ($todo['category'] == 'HOUSE') : ?>
                            <i class="fa-solid fa-house"></i>
                        <?php endif; ?>
                        <input type="text" value="<?php echo $todo['title'] ?>" id="title_task_<?php echo $todo['id']; ?>" name="title" onchange="updateData(<?php echo $todo['id']; ?>)" class="title_task">


                    <?php } ?>
                    <br>

                </div>

            <?php } ?>

        </div>


        <!--  -->
        <script>
            document.getElementById('edit-button').addEventListener('click', function() {
                var id = this.getAttribute('data-task-id');
                var title = prompt('Enter the new title:');

                if (title) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'edit.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                document.getElementById('title-' + id).textContent = title;
                            } else {
                                alert('Error updating title: ' + response.error);
                            }
                        }
                    };
                    xhr.send('id=' + id + 'title=' + encodeURIComponent(title));
                }
            });


            function makeEditable(title_task, id) {
                // Get the input field and button elements
                var inputField = document.getElementById(title_task);
                var editButton = document.querySelector('button[type="submit"]');

                // Remove the "readonly" attribute from the input field
                inputField.removeAttribute("readonly");

                // Focus on the input field
                inputField.focus();

                // Disable the edit button
                editButton.disabled = true;


                inputField.addEventListener("blur", function() {
                    inputField.setAttribute("readonly", "readonly");



                });
            }
        </script>
        <!--  -->


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
                                location.reload();
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


                            var input = $(this).next('.title_task');
                            if (data === '1') {
                                input.removeClass("checked");
                                location.reload();
                            } else {
                                input.addClass("checked");
                                location.reload();
                            }
                        }
                    });
                });
            });

            function updateData(id) {
                const input = document.getElementById('title_task_' + id);
                const value = input.value;

                // Send an AJAX request to the server to update the data
                $.ajax({
                    type: "POST",
                    url: "edit.php",
                    data: {
                        id: id,
                        title: value
                    },
                    success: function(data) {
                        // Reload the page after the update is complete
                        location.reload();
                    }
                });
            }
        </script>
</body>

</html>