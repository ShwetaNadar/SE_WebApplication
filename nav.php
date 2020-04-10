<!-- example 6 - center on mobile -->
<nav class="navbar navbar-expand-lg navbar">
    <div class="d-flex flex-grow-1">
        <span class="w-100 d-lg-none d-block"><!-- hidden spacer to center brand on mobile --></span>
        <a class="navbar-brand d-none d-lg-inline-block" href="home.php">
            <img src='cross.png'><b id='logo'>Hospital</b>
        </a>
        <a class="navbar-brand-two mx-auto d-lg-none d-inline-block" href="home.php">
            <img src="//placehold.it/40?text=LOGO" alt="logo">
        </a>
        <div class="w-100 text-right">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
    <div class="collapse navbar-collapse flex-grow-1 text-right" id="myNavbar">
        <ul class="navbar-nav ml-auto flex-nowrap">
            <li class="nav-item">
                <a href="dept.php" class="nav-link m-2 menu-item nav-active"><b>Departments</b></a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link m-2 menu-item"><b>Services</b></a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link m-2 menu-item"><b>Rooms</b></a>
            </li>
            <li class="nav-item">
                <a href="hist.php" class="nav-link m-2 menu-item"><b>Contact</b></a>
            </li>
        </ul>
    </div>
</nav>
