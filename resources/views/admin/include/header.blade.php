 <div class="layout-header">
      <div class="navbar navbar-default">
        <div class="navbar-header">
          <a class="navbar-brand navbar-brand-center" href="{{route('home')}}" target="_blank" style="width:100%; padding:0; margin:0 0 20px 0; text-align:center;">
            <img class="" src="{{ asset('assets/front/images/logo.jpg') }}" alt="ToonBD" style="width:100px; height:auto; text-align:center; margin:auto 0 20px 0">
          </a>
          <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#sidenav">
            <span class="sr-only">Toggle navigation</span>
            <span class="bars">
              <span class="bar-line bar-line-1 out"></span>
              <span class="bar-line bar-line-2 out"></span>
              <span class="bar-line bar-line-3 out"></span>
            </span>
            <span class="bars bars-x">
              <span class="bar-line bar-line-4"></span>
              <span class="bar-line bar-line-5"></span>
            </span>
          </button>
          <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="arrow-up"></span>
            <span class="ellipsis ellipsis-vertical">            	
              @if(Auth::user()->photo!="")
                      <img class="ellipsis-object" width="32" height="32" src="{{ asset('uploads/admin/'.Auth::user()->photo) }}" 
                      alt="<?php echo Auth::user()->fullname;?>" style="float:left; margin-right:5px;">
                  @else
                  	<img class="ellipsis-object" width="32" height="32" src="{{ asset('assets/images/defaultuser.png') }}" 
                      alt="<?php echo Auth::user()->fullname;?>" style="float:left; margin-right:5px;">
                  @endif
            </span>
          </button>
        </div>
        <div class="navbar-toggleable">
          <nav id="navbar" class="navbar-collapse collapse">
            <button class="sidenav-toggler hidden-xs" title="Collapse sidenav ( [ )" aria-expanded="true" type="button">
              <span class="sr-only">Toggle navigation</span>
              <span class="bars">
                <span class="bar-line bar-line-1 out"></span>
                <span class="bar-line bar-line-2 out"></span>
                <span class="bar-line bar-line-3 out"></span>
                <span class="bar-line bar-line-4 in"></span>
                <span class="bar-line bar-line-5 in"></span>
                <span class="bar-line bar-line-6 in"></span>
              </span>
            </button>
            <ul class="nav navbar-nav navbar-right">
              <li class="visible-xs-block">
                <h4 class="navbar-text text-center">Hi, <?php echo Auth::user()->name;?></h4>
              </li>
              
              
              
              <li class="dropdown hidden-xs">
                <button class="navbar-account-btn" data-toggle="dropdown" aria-haspopup="true">
                  @if(Auth::user()->photo!="")
                      <img class="ellipsis-object" width="32" height="32" src="{{ asset('uploads/admin/'.Auth::user()->photo) }}" 
                      alt="<?php echo Auth::user()->fullname;?>" style="float:left; margin-right:5px;">
                  @else
                  	<img class="ellipsis-object" width="32" height="32" src="{{ asset('assets/images/defaultuser.png') }}" 
                      alt="<?php echo Auth::user()->fullname;?>" style="float:left; margin-right:5px;">
                  @endif
				  <?php echo Auth::user()->fullname;?>
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">  
                  <li>
                  	<a href="{{ route('administration.logout') }}" onClick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> Logout</a><form id="logout-form" action="{{ route('administration.logout') }}" 
                    method="POST" style="display: none;">{{ csrf_field() }}</form>
                  </li>
                </ul>
              </li>
              
              <li class="visible-xs-block">
                <a href="{{ route('administration.logout') }}" onClick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> Logout</a><form id="logout-form" action="{{ route('administration.logout') }}" 
                    method="POST" style="display: none;">{{ csrf_field() }}</form>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
 <div class="layout-main">
      <div class="layout-sidebar">
        <div class="layout-sidebar-backdrop"></div>
        <div class="layout-sidebar-body">
          <div class="custom-scrollbar" style="margin-top:50px;">
            <nav id="sidenav" class="sidenav-collapse collapse">            
            
                
                  <ul class="sidenav">
                    <li class="sidenav-heading">Administration</li>    
                        <li class="sidenav-item"><a href="{{route('dashboard')}}"><span class="sidenav-icon icon icon-columns"></span><span class="sidenav-label">Dashboard</span></a></li>
                        <li class="sidenav-item has-subnav"><a href="#" aria-haspopup="true"><span class="sidenav-icon fa fa-user"></span><span class="sidenav-label">Admin</span></a>
                          <ul class="sidenav-subnav collapse">
                            <li><a href="{{ route('admins.index')}}"><span class="sidenav-icon fa fa-bars"></span>Admin List</a></li>
                            <li><a href="{{ route('admins.create')}}"><span class="sidenav-icon fa fa-plus"></span>New Admin</a></li>
                          </ul>
                        </li>
                        
                       <li class="sidenav-item has-subnav"><a href="#" aria-haspopup="true"><span class="sidenav-icon fa fa-map"></span><span class="sidenav-label">Why Choose</span></a>
                          <ul class="sidenav-subnav collapse">
                            <li><a href="{{ route('blog.index')}}"><span class="sidenav-icon fa fa-bars"></span>Content List</a></li>
                            <li><a href="{{ route('blog.create')}}"><span class="sidenav-icon fa fa-plus"></span>Add New Content</a></li>
                          </ul>
                        </li>
                        
                        <li class="sidenav-item has-subnav"><a href="#" aria-haspopup="true"><span class="sidenav-icon fa fa-map"></span><span class="sidenav-label">Circular</span></a>
                          <ul class="sidenav-subnav collapse">
                            <li><a href="{{ route('circular.index')}}"><span class="sidenav-icon fa fa-bars"></span>Circular List</a></li>
                            <li><a href="{{ route('circular.create')}}"><span class="sidenav-icon fa fa-plus"></span>Add New Circular</a></li>
                          </ul>
                        </li>
                        
                        <li class="sidenav-item has-subnav"><a href="#" aria-haspopup="true"><span class="sidenav-icon fa fa-map"></span><span class="sidenav-label">Our Services</span></a>
                          <ul class="sidenav-subnav collapse">
                            <li><a href="{{ route('service.index')}}"><span class="sidenav-icon fa fa-bars"></span>Services List</a></li>
                            <li><a href="{{ route('service.create')}}"><span class="sidenav-icon fa fa-plus"></span>Add New Service</a></li>
                          </ul>
                        </li>
                        
                        <li class="sidenav-item has-subnav"><a href="#" aria-haspopup="true"><span class="sidenav-icon fa fa-map"></span><span class="sidenav-label">Our Clients</span></a>
                          <ul class="sidenav-subnav collapse">
                            <li><a href="{{ route('partner.index')}}"><span class="sidenav-icon fa fa-bars"></span>Client List</a></li>
                            <li><a href="{{ route('partner.create')}}"><span class="sidenav-icon fa fa-plus"></span>Add New Client</a></li>
                          </ul>
                        </li>
                       
                        
                        <li class="sidenav-item has-subnav"><a href="#" aria-haspopup="true"><span class="sidenav-icon fa fa-map"></span><span class="sidenav-label">Counter</span></a>
                          <ul class="sidenav-subnav collapse">
                            <li><a href="{{ route('counter.index')}}"><span class="sidenav-icon fa fa-bars"></span>Counter List</a></li>
                            <li><a href="{{ route('counter.create')}}"><span class="sidenav-icon fa fa-plus"></span>Add New Counter</a></li>
                          </ul>
                        </li>
                        
                    
                        
                        <li class="sidenav-item has-subnav"><a href="#" aria-haspopup="true"><span class="sidenav-icon fa fa-map"></span><span class="sidenav-label">Management List</span></a>
                          <ul class="sidenav-subnav collapse">
                            <li><a href="{{ route('management.index')}}"><span class="sidenav-icon fa fa-bars"></span>Management List</a></li>
                            <li><a href="{{ route('management.create')}}"><span class="sidenav-icon fa fa-plus"></span>Add New</a></li>
                          </ul>
                        </li>
                                               
                        
                         <li class="sidenav-item has-subnav"><a href="#" aria-haspopup="true">
                        <span class="sidenav-icon fa fa-map"></span><span class="sidenav-label">Employee List</span></a>
                          <ul class="sidenav-subnav collapse">
                            <li><a href="{{ route('employee.index')}}"><span class="sidenav-icon fa fa-bars"></span>Employee List</a></li>
                            <li><a href="{{ route('employee.create')}}"><span class="sidenav-icon fa fa-plus"></span>Add New Employee</a></li>
                          </ul>
                        </li>
                        
                       
                        
                         <li class="sidenav-item has-subnav"><a href="#" aria-haspopup="true">
                        <span class="sidenav-icon fa fa-map"></span><span class="sidenav-label">Products List</span></a>
                          <ul class="sidenav-subnav collapse">
                            <li><a href="{{ route('product.index')}}"><span class="sidenav-icon fa fa-bars"></span>Products List</a></li>
                            <li><a href="{{ route('product.create')}}"><span class="sidenav-icon fa fa-plus"></span>Add New Product</a></li>
                          </ul>
                        </li>
                        
                        <li class="sidenav-item has-subnav"><a href="#" aria-haspopup="true">
                           <span class="sidenav-icon fa fa-map"></span><span class="sidenav-label">Protfolio</span></a>
                          <ul class="sidenav-subnav collapse">
                            <li><a href="{{ route('protfolio.index')}}"><span class="sidenav-icon fa fa-bars"></span>Protfolio List</a></li>
                            <li><a href="{{ route('protfolio.create')}}"><span class="sidenav-icon fa fa-plus"></span>Add New Protfolio</a></li>
                          </ul>
                        </li>
                        
                         <li class="sidenav-item has-subnav"><a href="#" aria-haspopup="true">
                           <span class="sidenav-icon fa fa-map"></span><span class="sidenav-label">Photo Gallery</span></a>
                          <ul class="sidenav-subnav collapse">
                            <li><a href="{{ route('gallery.index')}}"><span class="sidenav-icon fa fa-bars"></span>Gallery List</a></li>
                            <li><a href="{{ route('gallery.create')}}"><span class="sidenav-icon fa fa-plus"></span>Add New Image</a></li>
                          </ul>
                        </li>
                        
                        
                     <li class="sidenav-heading">Website Contents</li>  
                     	
                        <li class="sidenav-item has-subnav"><a href="#" aria-haspopup="true"><span class="sidenav-icon fa fa-list"></span><span class="sidenav-label">Video Gallery</span></a>
                      <ul class="sidenav-subnav collapse">
                        <li><a href="{{ route('video.index')}}"><span class="sidenav-icon fa fa-bars"></span>Video List</a></li>
                        <li><a href="{{ route('video.create')}}"><span class="sidenav-icon fa fa-plus"></span>New Video</a></li>
                      </ul>
                    </li>
                        
                         <li class="sidenav-item has-subnav"><a href="#" aria-haspopup="true">
                        <span class="sidenav-icon fa fa-user"></span><span class="sidenav-label">Banner</span></a>
                          <ul class="sidenav-subnav collapse">
                            <li><a href="{{ route('banner.index')}}"><span class="sidenav-icon fa fa-bars"></span>Banner List</a></li>
                            <li><a href="{{ route('banner.create')}}"><span class="sidenav-icon fa fa-plus"></span>New Banner</a></li>
                          </ul>
                        </li>     
                         <li class="sidenav-item has-subnav"><a href="#" aria-haspopup="true"><span class="sidenav-icon fa fa-list"></span><span class="sidenav-label">Usefull Link</span></a>
                          <ul class="sidenav-subnav collapse">
                            <li><a href="{{ route('usefulllink.index')}}"><span class="sidenav-icon fa fa-bars"></span>Link List</a></li>
                            <li><a href="{{ route('usefulllink.create')}}"><span class="sidenav-icon fa fa-plus"></span>New Link</a></li>
                          </ul>
                        </li>  
                        
                        <li class="sidenav-item has-subnav"><a href="#" aria-haspopup="true"><span class="sidenav-icon fa fa-list"></span><span class="sidenav-label">Menu</span></a>
                          <ul class="sidenav-subnav collapse">
                            <li><a href="{{ route('menus.index')}}"><span class="sidenav-icon fa fa-bars"></span>Menu List</a></li>
                            <li><a href="{{ route('menus.create')}}"><span class="sidenav-icon fa fa-plus"></span>New Menu</a></li>
                          </ul>
                        </li>  
                        
                        
                        <li class="sidenav-item has-subnav"><a href="#" aria-haspopup="true"><span class="sidenav-icon fa fa-list"></span><span class="sidenav-label">Content</span></a>
                          <ul class="sidenav-subnav collapse">
                            <li><a href="{{ route('contents.index')}}"><span class="sidenav-icon fa fa-bars"></span>Content List</a></li>
                            <li><a href="{{ route('contents.create')}}"><span class="sidenav-icon fa fa-plus"></span>Content Menu</a></li>
                          </ul>
                        </li>
                        
                   
                  </ul>
                      
                
            </nav>
          </div>
        </div>
      </div>
      
      
    