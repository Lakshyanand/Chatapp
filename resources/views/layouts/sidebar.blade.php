<aside class="main-sidebar sidebar-dark-primary elevation-4">

<a href="/adminpanel" class="brand-link">
<img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
<span class="brand-text font-weight-light">Admin Panel</span>
</a>

<div class="sidebar">

<div class="user-panel mt-3 pb-3 mb-3 d-flex">
<div class="image">
<img src="{{ asset('dist/img/2.jpg') }}" class="img-circle elevation-2" alt="User Image">
</div>
<div class="info">
<a href="#" class="d-block"> {{session('username')}} </a>
</div>
</div>

<!-- <div class="form-inline">
<div class="input-group" data-widget="sidebar-search">
<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
<div class="input-group-append">
<button class="btn btn-sidebar">
<i class="fas fa-search fa-fw"></i>
</button>
</div>
</div>
</div> -->

<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-widget="treeview"data-accordion="false">



<li class="nav-item menu-open">
<a href="/adminpanel" class="nav-link active">
<i class="nav-icon fas fa-tachometer-alt"></i>
<p>
Dashboard
<!-- <i class="right fas fa-angle-left"></i> -->
</p>
</a>
<!-- <ul class="nav nav-treeview">
<li class="nav-item">
<a href="#" class="nav-link active">
<i class="far fa-circle nav-icon"></i>
<p>Active Page</p>
</a>
</li>
<li class="nav-item">
<a href="#" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>Inactive Page</p>
</a>
</li>
</ul> -->
</li>

<!-- <li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon fas fa-th"></i>
<p>
Simple Link
<span class="right badge badge-danger">New</span>
</p>
</a>
</li> -->

<li class="nav-item">
    <form method="POST" action="toAgentPanel">
        @csrf
        <!-- <button type="submit">Agent Panel</button> -->
        <a  class="nav-link" style="margin-bottom:3px; color: #c2c7d0;"> <i class="far fa-circle nav-icon"></i>
                      <button type="submit" style="border:0px; padding-left: 0px; background-color:transparent; color: #c2c7d0;" ><p>Agent Dashboard</p> </button>
        </a>
    </form>
</li>

<li class="nav-item">
<a href="/addagent" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>Add Agent</p>
</a>
</li>

<!-- <li class="nav-item">
<a href="/agentlist" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>Agent List</p>
</a>
</li> -->

<li class="nav-item">
<a href="/logout" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>Logout</p>
</a>
</li>

</ul>
</nav>

</div>

</aside>