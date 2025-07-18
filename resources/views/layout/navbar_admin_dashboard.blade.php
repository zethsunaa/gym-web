<nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/admin_dashboard">GYM BLOG</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/admin_dashboard">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Manage Content
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/chest_manage">Chest</a></li>
            <li><a class="dropdown-item" href="/shoulder_manage">Shoulder</a></li>
            <li><a class="dropdown-item" href="/back_manage">Back</a></li>
            <li><a class="dropdown-item" href="/leg_manage">Leg</a></li>
          </ul>
        </li>
      </ul>
          <a href="" class="nav-item">{{ session('user_name') }}</a>
     <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-danger">Logout</button>
    </form>

    </div>
  </div>
</nav>
