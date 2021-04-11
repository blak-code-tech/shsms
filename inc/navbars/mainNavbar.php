<nav class="navbar navbar-light shadow-sm navbar-expand-lg fixed-top bg-white" style="height: 70px;" id="myNavbar">
<div class="container-fluid">
<a class="navbar-brand" href="<?php echo ROOT_URL;?>dashboard.php">Edukate</a>
<button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
    <span class="sr-only">Toggle navigation</span>
    <span class="navbar-toggler-icon"></span>
</button>
    <div class="collapse navbar-collapse" id="navcol-1">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item"><a class="nav-link hvr-underline-from-center" href="<?php echo ROOT_URL;?>dashboard.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link hvr-underline-from-center" href="<?php echo ROOT_URL;?>students.php">Students</a></li>
            <li class="nav-item"><a class="nav-link hvr-underline-from-center" href="<?php echo ROOT_URL;?>teachers.php">Teachers</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Finance
                </a>
                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
                    <li><a class="dropdown-item" href="<?php echo ROOT_URL;?>banks.php">Banks</a></li>
                    <li><a class="dropdown-item" href="<?php echo ROOT_URL;?>feescollection.php">Fees Collection</a></li>
                    <li><a class="dropdown-item" href="<?php echo ROOT_URL;?>home.php">Fees Structure</a></li>
                </ul>
            </li>
            <li class="nav-item"><a class="nav-link hvr-underline-from-center" href="<?php echo ROOT_URL;?>subjects.php">Subjects</a></li>
            <li class="nav-item"><a class="nav-link hvr-underline-from-center" href="<?php echo ROOT_URL;?>hostels.php">Hostels</a></li>
            <li class="nav-item"><a class="nav-link hvr-underline-from-center" href="<?php echo ROOT_URL;?>home.php">Classes</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Activities
                </a>
                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
                    <li><a class="dropdown-item" href="<?php echo ROOT_URL;?>banks.php">Events</a></li>
                    <li><a class="dropdown-item" href="<?php echo ROOT_URL;?>feescollection.php">Notice</a></li>
                </ul>
            </li>
        </ul>
        
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_URL;?>admin_login.php">Log Out</a></li>
        </ul>
    </div>
</div>
</nav>