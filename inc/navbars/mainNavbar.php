<nav class="navbar navbar-light shadow-sm navbar-expand-lg fixed-top bg-white" style="height: 70px;" id="myNavbar">
    <div class="container-fluid">
    <a class="navbar-brand bg text-center" href="<?php echo ROOT_URL;?>dashboard.php" style="font-size: 30px; font-weight: 700;">Edukate</a>
    <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navcol-1">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item"><a class="nav-link hvr-underline-from-center" href="<?php echo ROOT_URL;?>dashboard.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link hvr-underline-from-center" href="<?php echo ROOT_URL;?>students.php">Students</a></li>
            <li class="nav-item"><a class="nav-link hvr-underline-from-center" href="<?php echo ROOT_URL;?>staff.php">Staff</a></li>
            <li class="nav-item"><a class="nav-link hvr-underline-from-center" href="<?php echo ROOT_URL;?>classes.php">Classes</a></li>
            <li class="nav-item"><a class="nav-link hvr-underline-from-center" href="<?php echo ROOT_URL;?>subjects.php">Subjects</a></li>
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
            <li class="nav-item"><a class="nav-link hvr-underline-from-center" href="<?php echo ROOT_URL;?>hostels.php">Hostels</a></li>
            <li class="nav-item"><a class="nav-link hvr-underline-from-center" href="<?php echo ROOT_URL;?>parents.php">Parents</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Activities
                </a>
                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
                    <li><a class="dropdown-item" href="<?php echo ROOT_URL;?>events.php">Events</a></li>
                    <li><a class="dropdown-item" href="<?php echo ROOT_URL;?>notices.php">Notice</a></li>
                </ul>
            </li>
        </ul>
        
        <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
                
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img style="width: 40px;
                            height: 40px;" 
                            src="assets/img/user.png" class="img-raised rounded-circle" alt="user"> <?php echo substr($_SESSION['fname'],0,1).'. '. $_SESSION['lname'];?>
                </a>
                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
                    <li><a class="dropdown-item" href="<?php echo ROOT_URL;?>profile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="<?php echo ROOT_URL;?>inc/unSetSession.php">Log Out</a></li>
                </ul>
            </li>
        </ul>
        
    </div>
</div>
</nav>