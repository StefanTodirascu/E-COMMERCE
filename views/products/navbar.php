<!-- navbar.php -->

<?php
// Includi il file di configurazione o qualsiasi file necessario
// per ottenere lo stato di login dell'utente.
// Imposta $isLoggedIn in base allo stato di login.
$isLoggedIn = isset($_SESSION['current_user']); // Cambia questo in base alle tue esigenze.
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">ECOMMERCE</a>

    <?php if ($isLoggedIn):
        $user = $_SESSION['current_user']?>
        <!-- Parte della navbar per utente loggato -->
        <div class="navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    <?php else: ?>
        <!-- Parte della navbar per utente non loggato -->
        <div class="navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php">Registrati</a>
                </li>
            </ul>
        </div>
    <?php endif; ?>
</nav>
