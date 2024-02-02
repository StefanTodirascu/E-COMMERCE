<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();

}
$isLoggedIn = isset($_SESSION['current_user']);
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <a class="navbar-brand ms-5" href="index.php">ECOMMERCE</a>

    <?php if ($isLoggedIn):
        $user = $_SESSION['current_user'];
        $user->getId() ?>
        <a class="btn btn-primary" href="../cart.php">Carrello</a>

        <div class="navbar-collapse justify-content-end me-5" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="navbar-text"
                          style="margin-right: 15px;">Benvenuto <?php echo $user->getEmail() ?>
                    </span>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-success" href="../../actions/logout.php">Logout</a>
                </li>
            </ul>
        </div>

    <?php else: ?>
        <div class="navbar-collapse justify-content-end me-5" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="btn btn-outline-success me-2" href="../login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-success" href="../sign_up.php">Registrati</a>
                </li>
            </ul>
        </div>
    <?php endif; ?>
</nav>
