<?php
include 'partials/_dbconnect.php';
?>

<?php
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
    <a class="navbar-brand" href="/prforum">Idiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/prforum">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="about.php">About</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Top categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
//Calling categories from threadlist to top categories
$sql = "SELECT category_name, category_id FROM `categories`";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo ' <a class="dropdown-item" href="threadlist.php?catid=' . $row['category_id'] . '">' . $row['category_name'] . '</a>';
}


echo '</ul>
        </li>
            <li class="nav-item">
                <a class="nav-link active" href="contact.php" tabindex="-1" >Contact</a>
            </li>
        </ul>';


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo '<form class="d-flex my-0" action ="search.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
          <p class="text-light my-2 mx-1">Welcome:' . $_SESSION['useremail'] . '</p>
          <a href="partials/_logout.php" class="btn btn-primary">Logout</a>
          </form>';
} else {
    echo '<form class="d-flex my-0">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <div class="mx-2">  
        <butten type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal"">Login</butten>
        <butten type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupModal"">Signup</butten>
        </div>';
}


echo '</div>
</div>
</nav>';

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
if (isset($_GET['$signupsuccess']) && $_GET['$signupsuccess'] == "true") {
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
    <strong>Success!</strong> You can now login.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}