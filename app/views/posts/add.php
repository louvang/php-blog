<?php require APPROOT.'/views/inc/header.php'; ?>
  <div class="row">
    <div class="col">
      <div class="card">
        
        <div class="title-row">
          <h1>Add Posts</h1>
          <a href="<?php echo URLROOT; ?>/posts" class="btn btn-gray"><i class="fa fa-backward"></i> Back</a>
        </div>
        
        <form action="<?php echo URLROOT; ?>/posts/add" method="post">
          
          <div class="add-post-row">
            <label for="title"><sup>*</sup>Title:</label>
            <input type="text" name="title" value="<?php echo $data['title']; ?>"/>
            <span class="error"><?php echo $data['title_err']; ?></span>
          </div>
          <div class="add-post-row">
            <label for="body"><sup>*</sup>Body:</label>
            <textarea name="body"><?php echo $data['body']; ?></textarea>
            <span class="error"><?php echo $data['body_err']; ?></span>
          </div>

          <div class="flex">
            <div class="col">
              <button>Add Post</button>
            </div>
          </div>

        </form>

      </div>
    </div>
  </div>
<?php require APPROOT.'/views/inc/footer.php'; ?>