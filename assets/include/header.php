<?php
// Assurez-vous que la session est déjà démarrée avant d'inclure ce fichier
function getActiveClass($page, $activePage) {
    return ($activePage === $page) ? 'active' : '';
}

function displayHeader(
    $primaryColor = '#667eea',
    $secondaryColor = '#764ba2',
    $brandName = 'BrandName',
    $activePage = ''
) {
    // Récupérer les infos utilisateur depuis la session
    $userId   = $_SESSION['id_membre'] ?? '';
    $userName = getMembre($userId)['nom'] ?? 'Utilisateur';
    $userPhoto=  getMembre($userId)['image_profil'] ?? '../assets/1.png';
?>
    <!-- FontAwesome & Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">

    <nav class="navbar navbar-expand-lg navbar-dark custom-header"
         style="background: linear-gradient(135deg, <?= $primaryColor ?> 0%, <?= $secondaryColor ?> 100%);">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
          <i class="fas fa-rocket me-2"></i>
          <?= htmlspecialchars($brandName, ENT_QUOTES, 'UTF-8') ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link <?= getActiveClass('dep', $activePage) ?>" href="liste_objet.php">
                <i class="fas fa-home me-1"></i> Liste Objets
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= getActiveClass('employee', $activePage) ?>" href="filtre.php">
                <i class="fas fa-info-circle me-1"></i> Catégorie
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= getActiveClass('stats', $activePage) ?>" href="#">
                <i class="fas fa-cogs me-1"></i> Filtre
              </a>
            </li>
          </ul>

          <!-- Profil utilisateur -->
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle d-flex align-items-center" href="profil.php"
                 id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?= htmlspecialchars($userPhoto, ENT_QUOTES, 'UTF-8') ?>"
                     alt="Avatar" class="rounded-circle me-2" width="32" height="32">
                <span><?= htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') ?>
                      <small class="text-muted">(ID: <?= htmlspecialchars($userId, ENT_QUOTES, 'UTF-8') ?>)</small>
                </span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li><a class="dropdown-item" href="profil.php">
                  <i class="fas fa-user me-1"></i> Mon profil
                </a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php">
                  <i class="fas fa-sign-out-alt me-1"></i> Déconnexion
                </a></li>
              </ul>
            </li>
          </ul>

        </div>
      </div>
    </nav>
<?php
}
?>
