
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->

 <!--   <section class="panel panel-default">
     <header class="panel-heading">
      <input type="text" name="searchname" class="form-method" width="50px" height="50px" id="searchname" placeholder="Search....."  >
    </header>
  </section> -->

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('product.index') }}">Brand</a>

    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     <form class="navbar-form navbar-left" role="search">
      <div class="input-group">
        <input type="text" name="searchname" class="form-control "  id="searchname" placeholder="Search....." style=" margin-left: 200px;  width: 350px; " >
          <div class="input-group-btn">
              <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
      </div>
    </form>

      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="{{route('product.shoppingCart')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> 
             Shopping Cart
             <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
          </a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i> User Managment<span class="caret"></span></a>
          <ul class="dropdown-menu">
            @if(Auth::check())

            <li><a href="{{ route('user.profile')}}">User Profile</a></li>
            <li role="separator" class="divider"></li>

            <li><a href="
            {{route('user.logout')}}">Logout</a></li>
            @else
             <li><a href="{{ route('user.signup')}}">Signup</a></li>
            <li><a href="{{route('user.signin')}}">Signin</a></li>
            @endif
           
            
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>



@section('scripts')



<!-- 
<script type="text/javascript" src="{{ URL::to('js/search.js') }}"></script> -->

<script type="text/javascript">
  $('#searchname').autocomplete({

    
    source : '{!!URL::route('autocomplete')!!}',
    minlenght:3,
    autoFocus:true,
    select:function(e,ui){
      
   // $('#id').val(ui.item.id);
   // $('#name').val(ui.item.value);

    }

  });
</script>
@endsection

