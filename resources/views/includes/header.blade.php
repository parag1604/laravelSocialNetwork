<header>
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ URL::to('dashboard') }}">Social Network</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				{{-- <ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#">About</a></li>
					<li><a href="#">Contact</a></li>
				</ul> --}}
				@if (Auth::User())
				<ul class="nav navbar-nav navbar-right">
					<li><a href="{{ URL::to('account') }}">Account</a></li>
					<li><a href="{{ URL::to('logout') }}">Logout</a></li>
				</ul>
				@endif
			</div>
		</div>
	</nav>
</header>
