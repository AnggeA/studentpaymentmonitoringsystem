<!DOCTYPE html>
<html>
    <body>
        <div class="container-fluid">
        <div class="row" id="NavigationPanel">
            <!-- Navigation Bar -->
            <nav class="navbar fixed-top navbar-expand-lg bg-light shadow-sm">
                <div class="container-fluid">
                    <a href="admin.php" class="navbar-brand style-logo1 pb-1 ">
                       <span style="color:3AAFA9;">Payment <span class="text-dark">Monitoring System</span></span>
                    </a>
                    <div class="dropdown float-right">
                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="viewprofile.php"><i class="bi bi-person"></i> <?php echo $_SESSION['userlogged']; ?></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="includes/processlogout.inc.php" class="nav-link ">
                                <i class="bi bi-power"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!--end Navigation Bar -->
            </div>
        </div>
    </body>
</html>