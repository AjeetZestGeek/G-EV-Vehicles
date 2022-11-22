<?php
session_start();
if(!isset($_SESSION['user_data'])){
  echo '<script>alert("Access Denied");window.location = "../index.php";</script>';
}else{
    $userdata = $_SESSION['user_data'];
    // echo '<pre>';print_r($userdata);die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>G-EV-Vehicle</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link rel="stylesheet" href="asset/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

<!-- Basic Sidebar -->
  <div class="full-visual">
        <aside class="slidebar active" id="sidebar">
            <div class="sidebar-sticky">
                <a class="navbar-brand" href="index.php">G EV Vehicles</a>
                <ul class="nav flex-column">
                    <li class="nav-item">

                        <a class="nav-link" href="index.php">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                      <button class="dropdown-btn sidebar-drop"><i class="fa fa-users" aria-hidden="true"></i>Users
                        <i class="fa fa-caret-down"></i>
                      </button>
                      <div class="dropdown-container">
                        <a href="userlist.php">User List</a>
                        <a href="addUser.php">Add Users</a>
                      </div>
                    </li>
                    <li class="nav-item">
                      <button class="dropdown-btn sidebar-drop"><i class="fa fa-blog" aria-hidden="true"></i>Blogs
                        <i class="fa fa-caret-down"></i>
                      </button>
                      <div class="dropdown-container">
                        <a href="blogCategory.php">Category</a>
                        <a href="addCategory.php">Add Category</a>
                        <a href="blogList.php">Blog List</a>
                        <a href="addBlog.php">Add Blog</a>
                      </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            About Us
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <main class="main">
            <nav class="navbar navbar-dark bg-drk-purple fixed-top flex-md-nowrap shadow justify-content-between">
                <i class="fa fa-bars" aria-hidden="true"></i>
                <ul class="navbar-nav px-3">
                    <li class="nav-item text-nowrap">
                        <a class="nav-link text-dark" href="db/logout.php">Logout</a>
                    </li>
                </ul>
            </nav>