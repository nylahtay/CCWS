<?php
$conn = new Mysql();
$locations = $conn->getLocations();
$loc_id = filter_input(INPUT_GET, 'loc');
$action = filter_input(INPUT_GET, 'action');
?>


<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky d-flex flex-column p-3">
                    <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link btn <?php echo ($action == 'dashboard') ? 'active' : '' ?> d-inline-flex align-items-center rounded border-0" aria-current="page" href="?action=dashboard">
                        <button class="btn <?php echo ($action == 'dashboard') ? 'active' : '' ?> d-inline-flex align-items-center rounded border-0">
                        <span data-feather="home" class="align-text-bottom"></span>
                        Dashboard
                        </button>
                        </a>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#locations-collapse" aria-expanded="true">
                        Locations
                        </button>
                        <div class="collapse show" id="locations-collapse" style="">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <?php foreach ($locations as $location) :
                                $name = $location->getName();
                                $id = $location->getId();
                            ?>
                            <li><a href="?action=location&loc=<?= $id; ?>" class="link-dark d-inline-flex text-decoration-none <?php echo ($loc_id === $id) ? 'active ' : '';?>rounded"><?= $name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=guests">
                        <span data-feather="file-text" class="align-text-bottom"></span>
                        Guests
                        </a>
                    </li>
                    <!-- <li class="mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#users-collapse" aria-expanded="false">
                        Users
                        </button>
                        <div class="collapse" id="users-collapse" style="">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="?action=guests" class="link-dark d-inline-flex text-decoration-none rounded">Guests</a></li>
                        </ul>
                        </div>
                    </li> -->
                    
                    <li class="mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#reports-collapse" aria-expanded="false">
                        Reports
                        </button>
                        <div class="collapse" id="reports-collapse" style="">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Today</a></li>
                            <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">This Week</a></li>
                            <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">This Month</a></li>
                            <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Year</a></li>
                        </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                        <span data-feather="users" class="align-text-bottom"></span>
                        Settings
                        </a>
                    </li>
                    </ul>

                    <!-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                    <span>Saved reports</span>
                    <a class="link-secondary" href="#" aria-label="Add a new report">
                        <span data-feather="plus-circle" class="align-text-bottom"></span>
                    </a>
                    </h6>
                    <ul class="nav flex-column mb-md-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                        <span data-feather="file-text" class="align-text-bottom"></span>
                        Current month
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                        <span data-feather="file-text" class="align-text-bottom"></span>
                        OTHER REPORT
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                        <span data-feather="file-text" class="align-text-bottom"></span>
                        OTHER REPORT
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                        <span data-feather="file-text" class="align-text-bottom"></span>
                        OTHER REPORT
                        </a>
                    </li>
                    </ul> -->

                    <hr>

                    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong>mdo</strong>
      </a>
      <ul class="dropdown-menu text-small shadow" style="">
        <li><a class="dropdown-item" href="#">Account</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Sign out</a></li>
      </ul>
    </div>
                </div>
                </nav>