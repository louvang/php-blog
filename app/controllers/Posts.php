<?php
  class Posts extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->postModel = $this->model('Post');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get posts
      $posts = $this->postModel->getPosts();

      $data = [
        'posts' => $posts
      ];

      $this->view('posts/index', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(htmlspecialchars(INPUT_POST));

        $data = [
          'title' => trim($_POST['title']),
          'body' => trim($_POST['body']),
          'user_id' => $_SESSION['user_id'],
          'title_err' => '',
          'body_err' => ''
        ];

        // Validate title
        if(empty($data['title'])){
          $data['title_err'] = 'Please enter a title.';
        }

        // Validate body
        if(empty($data['body'])){
          $data['body_err'] = 'Please enter a body.';
        }

        // Make sure there are no errors
        if(empty($data['title_err']) && empty($data['body_err'])){
          if($this->postModel->addPost($data)){
            flash('post_message', 'Post Added');
            redirect('posts');
          } else {
            die('Something went wrong.');
          }
        } else {
          // Load view with errors 
          $this->view('posts/add', $data);
        }
      } else {
        $data = [
          'title' => '',
          'title_err' => '',
          'body' => '',
          'body_err' => ''
        ];

        $this->view('posts/add', $data);
      }
    }

    public function edit($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(htmlspecialchars(INPUT_POST));

        $data = [
          'id' => $id,
          'title' => trim($_POST['title']),
          'body' => trim($_POST['body']),
          'user_id' => $_SESSION['user_id'],
          'title_err' => '',
          'body_err' => ''
        ];

        // Validate title
        if(empty($data['title'])){
          $data['title_err'] = 'Please enter a title.';
        }

        // Validate body
        if(empty($data['body'])){
          $data['body_err'] = 'Please enter a body.';
        }

        // Make sure there are no errors
        if(empty($data['title_err']) && empty($data['body_err'])){
          if($this->postModel->updatePost($data)){
            flash('post_message', 'Post Updated');
            redirect('posts');
          } else {
            die('Something went wrong.');
          }
        } else {
          // Load view with errors 
          $this->view('posts/edit', $data);
        }
      } else {
        // Get existing post from model
        $post = $this->postModel->getPostById($id);
        
        // Check for owner
        if($post->user_id != $_SESSION['user_id']){
          redirect('posts');
        }

        $data = [
          'id' => $id, 
          'title' => $post->title,
          'title_err' => '',
          'body' => $post->body,
          'body_err' => ''
        ];

        $this->view('posts/edit', $data);
      }
    }

    public function show($id){
      $post = $this->postModel->getPostById($id);
      $user = $this->userModel->getUserById($post->user_id);

      $data = [
        'post' => $post,
        'user' => $user
      ];

      $this->view('posts/show', $data);
    }
  }