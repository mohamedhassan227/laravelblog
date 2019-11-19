	<!DOCTYPE html>
	<html lang="en">
	@include('partials._head')

	    <body>
	@include('partials._nav')

	    
	    <!-- main-content -->
	    <div class="container">
	    	@include('partials._massages')

	       @yield('content')
	    </div>

	@include('partials._fotter')

	  </body>
	</html>
	   