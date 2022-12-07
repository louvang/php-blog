<?php require APPROOT.'/views/inc/header.php'; ?>
  <div class="row">
    <div class="col">
      <div class="card">
        <h2>Create an Account</h2>
        <p>Fill out the form to register.</p>
        
        <form action="<?php echo URLROOT; ?>/users/register" method="post">
          <div class="form-row">
            <label for="name"><sup>*</sup>Name:</label>
            <input type="text" name="name" value="<?php echo $data['name']; ?>" required/>
            <span class="error"><?php echo $data['name_err']; ?></span>
          </div>
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
          <div class="form-row">
            <label for="confirm_password"><sup>*</sup>Confirm Password:</label>
            <input type="password" name="confirm_password" value="<?php echo $data['confirm_password']; ?>"/>
            <span class="error"><?php echo $data['confirm_password_err']; ?></span>
          </div>

          <div class="flex">
            <div class="col">
              <button>Register</button>
            </div>
            <div class="col">
              Have an account? <a href="<?php echo URLROOT; ?>/users/login">Login</a>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
<?php require APPROOT.'/views/inc/footer.php'; ?>