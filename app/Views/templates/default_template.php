<!DOCTYPE html>
<html>
<?= $this->include('layout\header') ?>

<body class="d-flex flex-column min-vh-100" style="min-height: 100vh;">
   <?= $this->include('layout\menu-bar') ?>
   <div class="container-fluid main_container">
      <div class="row">
         <div class="col-3">
            <?= $this->include('layout\left-bar'); ?>
         </div>
         <div class="col-9">
            <?php if (isset($GLOBALS['sBreadcrumb'])) { ?> 
               <nav aria-label="breadcrumb">
                   <ol class="breadcrumb">
                     <?php echo $GLOBALS['sBreadcrumb']; ?>
                  </ol>
               </nav>
               <?php } ?>
            <?php echo $GLOBALS['tmp_data']; ?>
         </div>
      </div>
   </div>
   <?= $this->include('layout\footer') ?>
   <?php if (isset($GLOBALS['sJs'])) echo $GLOBALS['sJs']; ?>
</body>

</html>