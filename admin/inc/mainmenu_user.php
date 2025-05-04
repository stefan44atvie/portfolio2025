<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top bg-white">
  <div class="container-fluid">
    <a class="navbar-brand" href="#portfolio_startscreen">
        <img src="components/media/Logos/D&S_Logo_200x115.jpg" height="20px" alt="Logo" loading="lazy" />
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link " aria-current="page" href="index.php">Home</a>
        </li>
      </ul>
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'logout.php') ? 'active' : ''; ?>" aria-current="page" href="logout.php?logout">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Navbar -->