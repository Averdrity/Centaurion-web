<?php $isLoggedIn = isset($_SESSION['user_id']); ?>
<header class="fixed top-0 left-0 right-0 bg-light-card dark:bg-dark-card shadow-lg z-50 transition-colors duration-200">
  <nav class="container mx-auto px-4 py-4">
    <div class="flex justify-center items-center relative">

      <!-- Left: Home + Soon -->
      <div class="absolute left-[80px] flex items-center gap-2">
        <a href="/index.php" class="nav-button">
          <span class="icon" style="background-image: url('/assets/icons/tabler/home.svg')"></span>
          <span>Home</span>
        </a>
        <button class="nav-button" disabled>
          <span class="icon" style="background-image: url('/assets/icons/tabler/sparkles.svg')"></span>
          <span>Soon</span>
        </button>
      </div>

      <!-- Center: Logo -->
      <a href="/" class="logo-container">
  <!-- Light Mode Logo -->
  <img src="/assets/images/logo/logo-light.png" alt="Logo" class="logo-image dark:hidden animate-pulse-slow">
  
  <!-- Dark Mode Logo -->
  <img src="/assets/images/logo/logo-dark.png" alt="Logo" class="logo-image hidden dark:block animate-pulse-slow">
</a>


      <!-- Right: Auth Buttons -->
      <div class="absolute right-[80px] flex items-center gap-2">
        <?php if ($isLoggedIn): ?>
          <button onclick="openModal('profileModal')" class="nav-button">
            <span class="icon" style="background-image: url('/assets/icons/tabler/user.svg')"></span>
            <span>Profile</span>
          </button>
          <button onclick="logout()" class="nav-button">
            <span class="icon" style="background-image: url('/assets/icons/tabler/logout.svg')"></span>
            <span>Logout</span>
          </button>
        <?php else: ?>
          <button onclick="openModal('loginModal')" class="nav-button">
            <span class="icon" style="background-image: url('/assets/icons/tabler/login.svg')"></span>
            <span>Login</span>
          </button>
          <button onclick="openModal('registerModal')" class="nav-button">
            <span class="icon" style="background-image: url('/assets/icons/tabler/user-plus.svg')"></span>
            <span>Register</span>
          </button>
        <?php endif; ?>
      </div>
    </div>
  </nav>
</header>

<!-- Prevent overlap -->
<div class="h-16"></div>
