<!DOCTYPE html>
<html>
<?= $this->include('layout\header') ?>
<body class="d-flex flex-column min-vh-100" style="min-height: 100vh;">
   <?= $this->include('layout\menu-bar') ?>
   <div id="container-fluid main_container">
      <div class="row">
         <div class="col-3">
            <?= $this->include('layout\left-bar'); ?>
         </div>
         <div class="col-9">
            <!-- <?= $this->renderSection('content') ?> -->
            <?php 
            echo $GLOBALS['tmp_data']; ?>
            content in home page
         </div>
      </div>
   </div>
   <?= $this->include('layout\footer') ?>
   <?php if(isset($GLOBALS['sJs'])) echo $GLOBALS['sJs']; ?>
</body>

</html>