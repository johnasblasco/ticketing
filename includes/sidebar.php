<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

 <aside id="left-panel" class="left-panel mt-4">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="dashboard.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                   
                    <li>
                        <a href="add-vehicle.php"> <i class="menu-icon fas fa-car"></i>Park In Vehicle </a>
                    </li>
                    <li>
                        <a href="search-vehicle.php"> <i class="menu-icon fas fa-car"></i>Park Out Vehicle </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Manage Vehicle</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fas fa-car"></i><a href="manage-incomingvehicle.php">Park In  Vehicle</a></li>
                            <li><i class="menu-icon fas fa-car"></i><a href="manage-outgoingvehicle.php">Park Out Vehicle</a>
                           
                        </li>

                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Vehicle Category</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="add-category.php">Add Category</a></li>
                            <li><i class="fa fa-table"></i><a href="manage-category.php">Manage Category</a></li>
                        </ul>
                    </li>
                    
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Reports</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="bwdates-report-ds.php">Between Dates Reports</a></li>
                           
                        </ul>
                    </li>
                    <!-- create account  -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Create User Account</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="create_user.php">Create</a></li>
                            <li><i class="menu-icon fa fa-th"></i><a href="users_list.php">List of Users</a></li>
                           
                        </ul>
                    </li>
                    <!-- end create account -->
                    <li>
                        <a href="logtable.php"> <i class="menu-icon ti-email"></i>Log Table </a>
                    </li>
                    <li>
                        <a href="about.php"> <i class="menu-icon ti-email"></i>About</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>