<?php
  class Users extends Controller {
    public function __construct(){
      $this->userModel = $this->model('User');
    }

    public function register(){
      // check for POST
      if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // Process form

        // Sanitize POST data
        $_POST = filter_input_array(htmlspecialchars(INPUT_POST));

        // Init Data
        $data = [
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Validate email
        if(empty($data['email'])){
          $data['email_err'] = 'Please enter email.';
        } else {
          // Check email
          if($this->userModel->findUserByEmail($data['email'])){
            $data['email_err'] = 'Email already taken.';
          }
        }

        // Validate name
        if(empty($data['name'])){
          $data['name_err'] = 'Please enter name.';
        }

        // Validate password
        if(empty($data['password'])){
          $data['password_err'] = 'Please enter password.';
        } else if(strlen($data['password']) < 8) {
          $data['password_err'] = 'Password must have at least 8 characters.';
        }

        // Validate confirm password
        if(empty($data['confirm_password'])){
          $data['confirm_password_err'] = 'Please confirm password.';
        } else {
          if($data['password'] != $data['confirm_password']) {
            $data['confirm_password_err'] = 'Passwords do not match.';
          }
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
          // Validated
          
          // Hash password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          if($this->userModel->register($data)) {
            flash('register_success', 'You are registered and can log in.');
            redirect('users/login');
          } else {
            die('Something went wrong');
          }
          
        } else {
          // Reload view with errors
          $this->view('users/register', $data);
        }


      } else {
        // Init data
        $data = [
          'name' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Load view
        $this->view('users/register', $data);
      }
    }

    public function login(){
      // check for POST
      if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(htmlspecialchars(INPUT_POST));

        // Init Data
        $data = [
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'email_err' => '',
          'password_err' => ''
        ];

        // Validate email
        if(empty($data['email'])){
          $data['email_err'] = 'Please enter email.';
        }

        // Validate password
        if(empty($data['password'])){
          $data['password_err'] = 'Please enter password.';
        } 

        // Check for user/email
        if($this->userModel->findUserByEmail($data['email'])){
          // User found 
        } else {
          $data['email_err'] = 'No such user exists.';
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['password_err'])){
          // Validated
          // Check and set logged in user
          $loggedInUser = $this->userModel->login($data['email'], $data['password']);

          if($loggedInUser){
            // create session variables
            $this->createUserSession($loggedInUser);
          } else {
            $data['password_err'] = 'Incorrect password.';

            $this->view('users/login', $data);
          }
        } else {
          // Reload view with errors
          $this->view('users/login', $data);
        }

      } else {
        // Init data
        $data = [
          'email' => '',
          'password' => '',
          'email_err' => '',
          'password_err' => ''
        ];

        // Load view
        $this->view('users/login', $data);
      }
    }

    public function createUserSession($user){
      $_SESSION['user_id'] = $user->id;
      $_SESSION['user_email'] = $user->email;
      $_SESSION['user_name'] = $user->name;
      redirect('pages/index');
    }

    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      session_destroy();
      redirect('users/login');
    }

    public function isLoggedIn(){
      if(isset($_SESSION['user_id'])){
        return true;
      } else {
        return false;
      }
    }
  }