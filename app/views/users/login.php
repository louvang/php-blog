<?php require APPROOT.'/views/inc/header.php'; ?>
  <div class="row">
    <div class="col">
      <div class="card">
        <?php echo flash('register_success'); ?>
      
        <h2>Log in</h2>
        <p>Fill in your information to login.</p>
        
        <form action="<?php echo URLROOT; ?>/users/login" method="post">
          
          <div class="form-row">
            <label for="email"><sup>*</sup>Email:</label>
            <input type="email" name="email" value="<?php echo $data['email']; ?>"/>
            <span class="error"><?php echo $data['email_err']; ?></span>
          </div>
          <div class="form-row">
            <label for="password"><sup>*</sup>Password:</label>
            <input type="password" name="password" value="<?php echo $data['password']; ?>"/>
            <span class="error"><?php echo $data['password_err']; ?></span>
          </div>

          <div class="flex">
            <div class="col">
              <button>Login</button>
            </div>
            <div class="col">
              Don't have an account? <a href="<?php echo URLROOT; ?>/users/register">Register</a>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
<?php require APPROOT.'/views/inc/footer.php'; ?>