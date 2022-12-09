<?php require APPROOT.'/views/inc/header.php'; ?>
  
<div class="card">
  <div class="title-row">
    <h1><?php echo $data['post']->title; ?></h1>
    <a href="<?php echo URLROOT; ?>/posts" class="btn btn-gray"><i class="fa fa-backward"></i> Back</a>
  </div>
  <div class="details-row">
    <div class="detail-item">
      <i class="fa fa-user"></i> Written by: <?php echo $data['user']->name; ?>
    </div>
    <div class="detail-item">
      <i class="fa fa-calendar"></i> Date posted: <?php echo $data['post']->created_at; ?>
    </div>
  </div>

  <div class="show-post-body">
    <?php echo $data['post']->body; ?>
  </div>

  <hr class="divider" />

  
  <?php if($data['post']->user_id == $_SESSION['user_id']) { ?>
    <div class="user-admin-row">
      <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn">Edit</a>
      
      <form action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="POST"> 
        <input type="submit" value="Delete" class="btn btn-red">
      </form>
    </div>
  <?php } ?>

</div>

<?php require APPROOT.'/views/inc/footer.php'; ?>
  