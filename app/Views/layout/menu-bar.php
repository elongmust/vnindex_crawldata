<?php
$uri = service('uri');
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/"><i class="fas fa-home"></i> Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/stocks"><i class="fas fa-chart-line"></i> Stocks <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/indexs"><i class="fas fa-chart-bar"></i> World Indexs </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/cryptocurrency"><i class="fab fa-btc"></i> Cryptocurrency</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/news"><i class="fas fa-newspaper"></i> News</a>
      </li>

      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="far fa-caret-square-down"></i> More
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method='post' action='/search'>
      <?= csrf_field() ?>
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <?php if (session()->get('isLoggedIn')) : ?>
      <ul class="navbar-nav my-2 my-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Hody, <span style="font-weight: 600; font-size: 16px; color: green;"><?php echo $_SESSION["full_name"];?></span>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="nav-link" href="/u/<?php echo $_SESSION["username"];?>"><i class="fa fa-user"></i> Trang cá nhân</a>
          <a class="nav-link" href="/profile"><i class="fa fa-history"></i> Quản lý hoạt động</a>
          <a class="nav-link" href="/setting"><i class="fa fa-cog"></i> Tùy chỉnh</a>
            <div class="dropdown-divider"></div>
            <a class="nav-link" href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </div>
        </li>
      </ul>
    <?php else : ?>
      <ul class="navbar-nav  my-2 my-lg-0">
        <li class="nav-item <?= ($uri->getSegment(1) == '' ? 'active' : null) ?>">
          <a class="nav-link" href="/login">Login</a>
        </li>
        <li class="nav-item <?= ($uri->getSegment(1) == 'signup' ? 'active' : null) ?>">
          <a class="nav-link" href="/signup">Register</a>
        </li>
      </ul>
    <?php endif; ?>
  </div>
</nav>