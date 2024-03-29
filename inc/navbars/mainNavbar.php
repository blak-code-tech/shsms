<?php $user = $_SESSION['UserType']; ?>
<nav class="navbar navbar-light shadow navbar-expand-lg fixed-top bg-white" id="myNavbar">
    <div class="container-fluid">
        <a class="navbar-brand bg text-center" href="<?php echo $_SERVER['PHP_SELF'];?>"
            style="font-size: 30px; font-weight: 800;">Edukate</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link hvr-underline-from-center"
                        href="<?php echo ROOT_URL;?>home.php">Home</a></li>
                <?php if($user === 'admin' || $user === 'Head Teacher' || $user === 'Assitant Head Teacher'):?>
                <li class="nav-item"><a class="nav-link hvr-underline-from-center"
                        href="<?php echo ROOT_URL;?>dashboard.php">Dashboard</a></li>
                <?php endif; ?>
                <?php if($user === 'admin' || $user === 'Head Teacher' || $user === 'Assitant Head Teacher'):?>
                <li class="nav-item"><a class="nav-link hvr-underline-from-center"
                        href="<?php echo ROOT_URL;?>students.php">Students</a></li>
                <li class="nav-item"><a class="nav-link hvr-underline-from-center"
                        href="<?php echo ROOT_URL;?>staff.php">Staff</a></li>
                <?php endif; ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Academics
                    </a>
                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">

                        <li><a class="dropdown-item" href="<?php echo ROOT_URL;?>courses.php">Courses</a></li>
                        <li><a class="dropdown-item" href="<?php echo ROOT_URL;?>subjects.php">Subjects</a></li>
                        <li><a class="dropdown-item" href="<?php echo ROOT_URL;?>examresults.php">Exams Results</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Finance
                    </a>
                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?php echo ROOT_URL;?>banks.php">Banks</a></li>
                        <li><a class="dropdown-item" href="<?php echo ROOT_URL;?>feescollection.php">Fees Collection</a>
                        </li>
                        <li><a class="dropdown-item" href="<?php echo ROOT_URL;?>home.php">Fees Structure</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Exams
                    </a>
                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?php echo ROOT_URL;?>examresults.php">Results</a></li>
                    </ul>
                </li>

                <?php if($user === 'admin'):?>
                <li class="nav-item"><a class="nav-link hvr-underline-from-center"
                        href="<?php echo ROOT_URL;?>hostels.php">Hostels</a></li>
                <li class="nav-item"><a class="nav-link hvr-underline-from-center"
                        href="<?php echo ROOT_URL;?>parents.php">Parents</a></li>
                <?php endif;?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
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

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img style="width: 40px;
                            height: 40px;" src="assets/img/user.png" class="img-raised rounded-circle" alt="user">
                        <?php echo substr($_SESSION['fname'],0,1).'. '. $_SESSION['lname'];?>
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