<nav class="navbar">
  <div class="navbar-logo"><?php echo SITENAME; ?></div>
  <ul class="navlist navlist-left">
    <li><a href="<?php echo URLROOT; ?>">Home</a></li>
    <li><a href="<?php echo URLROOT; ?>/pages/about">About</a></li>
  </ul>
  <ul class="navlist navlist-right">
    <?php if(isset($_SESSION['user_id'])){ ?>
      <li><a href="<?php echo URLROOT; ?>/users/logout">Logout</a></li>
    <?php } else { ?>
      <li><a href="<?php echo URLROOT; ?>/users/register">Register</a></li>
      <li><a href="<?php echo URLROOT; ?>/users/login">Login</a></li>
    <?php } ?>
    
  </ul>
</nav>