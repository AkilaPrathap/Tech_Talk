<!-- <h2><?= $title ?></h2> -->
<p>Welcome to the Tech_Talk application</p>

<div id="navbar">
  <ul class="nav navbar-nav">
    <li><a href="<?php echo site_url(); ?>">Home</a></li>
    <li><a href="<?php echo site_url('pages/about'); ?>">Blog</a></li>
    <li><a href="<?php echo site_url('categories'); ?>">Categories</a></li>
    <li><a href="<?php echo site_url('pages/about'); ?>">About us</a></li>
  </ul>
  <ul class="nav navbar-nav navbar-right">
    <?php if(!$this->session->userdata('logged_in')) : ?>
      <li><a href="<?php echo site_url('users/login'); ?>">Login</a></li>
      <li><a href="<?php echo site_url('users/register'); ?>">Register</a></li>
    <?php endif; ?>
    
      <li><a href="<?php echo site_url('Posts/create'); ?>">Create Post</a></li>
      <li><a href="<?php echo site_url('categories/create'); ?>">Create Category</a></li>
      <li><a href="<?php echo site_url('users/logout'); ?>">Logout</a></li>

  </ul>
</div>
