<?php require APPROOT.'/views/inc/header.php'; ?>
  <div class="title-row">
    <h1>Posts</h1>
    <a href="<?php echo URLROOT; ?>/posts/add" class="btn"><i class="fa fa-pencil"></i> Add Post</a>
  </div>

  <div class="posts">
    <?php foreach($data['posts'] as $post) { ?>
      <div class="card">
        <h2><?php echo $post->title; ?></h2>
        <div class="details-row">
          <div class="detail-item">
            <i class="fa fa-user"></i> Written by: <?php echo $post->name; ?>
          </div>
          <div class="detail-item">
            <i class="fa fa-calendar"></i> Date posted: <?php echo $post->postCreated; ?>
          </div>
        </div>
        
        <div class="post-body">
          <?php echo $post->body; ?>
        </div>

        <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn">View Post</a>
          
      </div>
    <?php } ?>

  </div>

<?php require APPROOT.'/views/inc/footer.php'; ?>