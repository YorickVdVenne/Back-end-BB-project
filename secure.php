<?php
require "header.php";
?>

    <main>
        <?php
            if (isset($_SESSION['userId'])) {
                echo '<div class="container">
                        <p class="row justify-content-center login-status">You are logged in!</p>';
            }
            else {
                header("Location: ../index.php");
                exit();
            }
        ?>
    </main>

<?php 
require "footer.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <?php require_once 'includes/process.inc.php'; ?>

    <?php 
    if (isset($_SESSION['message'])): 
    ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
    <?php endif ?>
    <?php 
        require 'includes/dbh.inc.php';

        $result = $conn->query("SELECT * From data") or die($conn->error);
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
        <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['location']); ?></td>
                    <td>
                        <a href="secure.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit </a>
                        <a href="includes/process.inc.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
        <?php endwhile; ?>
            </table>
        </div>
        <div class="spacing">
        <br><br>
        </div>
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo '<p class="error row justify-content-center">Fill in all fields!</p>';
            }
        }
        else if (isset($_GET['save']) == "succes") {
                echo '<p class=" succes row justify-content-center">Saved successfully!</p>';
        }
        else if (isset($_GET['update']) == "succes") {
            echo '<p class=" succes row justify-content-center">Updated successfully!</p>';
    }
            ?>

        <div class="row justify-content-center">
            <form action="includes/process.inc.php" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" class="form-control" value="<?php echo htmlspecialchars($location); ?>" placeholder="Enter your location">
                </div>
                <div class="form-group">
                <?php 
                if ($update == true):
                ?>
                    <button type="submit" name="update" class="btn btn-info">Update</button>
                <?php else: ?>
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                <?php endif; ?> 
                </div>
            </form>
        </div>
    </div>
    


    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>