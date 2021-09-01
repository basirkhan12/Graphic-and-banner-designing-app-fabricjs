<div class="sidebar" data-color="orange"><!--Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"-->
    <div class="logo">
      <a href="/" class="simple-text logo-normal">
        Banner Designing App
      </a>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
      <ul class="nav">
        <li>
          <a href="/designs/create">
            <i class="now-ui-icons design_app"></i>
            <p>Create New Design </p>
          </a>
        </li>
        <li class="{{ (request()->is('designs/my-templates')) ? 'active' : '' }}">
          <a href="/designs/my-templates">
            <i class="now-ui-icons design_image"></i>
            <p>Your Designs</p>
          </a>
        </li>
      
        <li class="{{ (request()->is('designs/templates')) ? 'active' : '' }}">
          <a href="/designs/templates">
            <i class="now-ui-icons media-1_album"></i>
            <p>All Designs</p>
          </a>
        </li>
        <li class="{{ (request()->is('my-favorite')) ? 'active' : '' }}">
          <a href="/my-favorite">
            <i class="now-ui-icons ui-2_favourite-28"></i>
            <p>My favorite Designs</p>
          </a>
        </li>
        <li class="{{ (request()->is('all-user')) ? 'active' : '' }}">
          <a href="/all-user">
            <i class="fa fa-users"></i>
            <p>All Designers</p>
          </a>
        </li>
        <li class="{{ (request()->is('profile')) ? 'active' : '' }}">
          <a href="/profile">
            <i class="now-ui-icons users_single-02"></i>
            <p>{{Auth::user()->name}}</p>
          </a>
        </li>
        
      </ul>
      
    </div>
  </div>
