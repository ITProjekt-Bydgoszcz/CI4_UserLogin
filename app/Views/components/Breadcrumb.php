<div class="block-header">
    <!-- <h2><?= $uri_1 ?> / <?= $uri_2 ?></h2>
</div> -->


  <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-bg-orange">
      <li class="breadcrumb-item "><a href="/dashboard">Home</a></li>
      <?= ($uri_1 == 'dashboard') ? false : '<li class="breadcrumb-item "><a href="/'.$uri_1.'">'.$uri_1.'</a></li>' ?>
      <?= (empty($uri_2)) ? false :'<li class="breadcrumb-item active" aria-current="page">'.$uri_2.'</li>' ?> 
    </ol>
  </nav>
</div>
