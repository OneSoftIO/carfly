<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon" />
		<title>CarFly.lt - Valdymo sistema</title>
		<link href="{{asset('admin/css/font-awesome.min.css') }}" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<link href="//cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
		<link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css" rel="stylesheet">
		<link href="{{asset('admin/css/icheck.css') }}" rel="stylesheet">
		<link href="{{asset('admin/css/toastr.min.css') }}" rel="stylesheet">
		<link href="{{asset('admin/css/switchery.min.css') }}" rel="stylesheet">
		<link href="{{asset('admin/css/style.css') }}" rel="stylesheet">


		<script src="{{asset('admin/js/jquery-2.1.1.js') }}"></script>
		<link href="{{asset('assets/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
		<script src="//cdn.ckeditor.com/4.7.0/standard/ckeditor.js"></script>

    </head>
    <body>
    <div id="wrapper">
		<nav class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav metismenu" id="side-menu">
					<li class="nav-header">
						<span class="block"><strong>Valdymo sistema</strong></span>
					</li>
					<li {{(URL::full() == route('admin.dashboard'))? "class=active" : ""}}>
						<a href="{{route('admin.dashboard')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Pradinis</span></a>
					</li>
					<li {{(URL::full() == route('admin.vehicles') || URL::full() == route('admin.vehicles.create')  )? "class=active" : ""}}>
						<a href="">
							<i class="fa fa-car"></i>
							<span class="nav-label ng-binding">Automobiliai</span>
							<span class="fa arrow"></span>
						</a>
						<ul class="nav nav-second-level collapse" aria-expanded="true">
							<li {{(URL::full() == route('admin.vehicles'))? "class=active" : ""}}><a href="{{route('admin.vehicles')}}">Automobiliai</a></li>
							<li {{(URL::full() == route('admin.vehicles.create'))? "class=active" : ""}}><a href="{{route('admin.vehicles.create')}}">Pridėti automobilį</a></li>
							<li class="line"></li>
							<li {{(URL::full() == route('admin.vehicles.category', 'lt'))? "class=active" : ""}}><a href="{{route('admin.vehicles.category', 'lt')}}">Pridėti komplektaciją</a></li>

						</ul>
					</li>
					<li {{(URL::full() == route('admin.pages') || URL::full() == route('admin.page.create', 'lt') )? "class=active" : ""}}>
						<a href="">
							<i class="fa fa-file-text-o"></i> 
							<span class="nav-label ng-binding">Puslapiai</span>
							<span class="fa arrow"></span>
						</a>
						<ul class="nav nav-second-level collapse" aria-expanded="true">
							<li {{(URL::full() == route('admin.pages'))? "class=active" : ""}}><a href="{{route('admin.pages')}}">Puslapiai</a></li>
							<li {{(URL::full() == route('admin.page.create', 'lt'))? "class=active" : ""}}><a href="{{route('admin.page.create', 'lt')}}">Pridėti puslapį</a></li>
						</ul>
					</li>
					<li {{(URL::full() == route('admin.posts') || URL::full() == route('admin.post.create') )? "class=active" : ""}}>
						<a href="">
							<i class="fa fa-pencil"></i> 
							<span class="nav-label ng-binding">Įrašai</span>
							<span class="fa arrow"></span>
						</a>
						<ul class="nav nav-second-level collapse" aria-expanded="true">
							<li {{(URL::full() == route('admin.posts'))? "class=active" : ""}}><a href="{{route('admin.posts')}}">Įrašai</a></li>
							<li {{(URL::full() == route('admin.post.create'))? "class=active" : ""}}><a href="{{route('admin.post.create')}}">Pridėti įrašą</a></li>
						</ul>
					</li>
					<li {{(URL::full() == route('admin.category') || URL::full() == route('admin.category.create') )? "class=active" : ""}}>
						<a href="">
							<i class="fa fa-database"></i> 
							<span class="nav-label ng-binding">Kategorijos</span>
							<span class="fa arrow"></span>
						</a>
						<ul class="nav nav-second-level collapse" aria-expanded="true">
							<li {{(URL::full() == route('admin.category'))? "class=active" : ""}}><a href="{{route('admin.category')}}">Kategorijos</a></li>
							<li {{(URL::full() == route('admin.category.create'))? "class=active" : ""}}><a href="{{route('admin.category.create')}}">Pridėti kategoriją</a></li>
						</ul>
					</li>
					<li {{(URL::full() == route('users.index')  )? "class=active" : ""}}>
						<a href="">
							<i class="fa fa-user"></i> 
							<span class="nav-label ng-binding">Vartotojai</span>
							<span class="fa arrow"></span>
						</a>
						<ul class="nav nav-second-level collapse" aria-expanded="true">
							<li {{(URL::full() == route('users.index'))? "class=active" : ""}}><a href="{{route('users.index')}}">Vartotojai</a></li>
							<li {{(URL::full() == route('users.create'))? "class=active" : null}}><a href="{{route('users.create')}}">Pridėti vartotoją</a></li>

						</ul>
					</li>
					<li {{(URL::full() == route('admin.subscribers') || URL::full() == route('admin.mail'))? "class=active" : ""}}>
						<a href="">
							<i class="fa fa-envelope-o"></i> 
							<span class="nav-label ng-binding">Prenumeratoriai</span>
							<span class="fa arrow"></span>
						</a>
						<ul class="nav nav-second-level collapse" aria-expanded="true">
							<li {{(URL::full() == route('admin.subscribers'))? "class=active" : null}}><a href="{{route('admin.subscribers')}}">Prenumeratoriai</a></li>
							{{--<li {{(URL::full() == route('admin.mail'))? "class=active" : ""}}><a href="{{route('admin.mail')}}">Siųsti laišką</a></li>--}}
						</ul>
					</li>
					<li {{(URL::full() == route('admin.orders'))? "class=active" : null}}>
						<a href="{{route('admin.orders')}}"><i class="fa fa-money"></i> <span class="nav-label">Mokėjimai</span></a>
					</li>
					<li {{(URL::full() == route('admin.lease') || URL::full() == route('admin.lease.add'))? "class=active" : null}}>
						<a href="">
							<i class="fa fa-bell"></i>
							<span class="nav-label ng-binding">Rezervacijos</span>
							<span class="fa arrow"></span>
						</a>
						<ul class="nav nav-second-level collapse" aria-expanded="true">
							<li {{(URL::full() == route('admin.lease'))? "class=active" : null}}><a href="{{route('admin.lease')}}"><span class="nav-label">Rezervacijos</span></a></li>
							<li {{(URL::full() == route('admin.lease.add'))? "class=active" : null}}><a href="{{route('admin.lease.add')}}">Rezervuoti mašiną</a></li>
						</ul>
					</li>
					<li {{(URL::full() == route('admin.meta'))? "class=active" : null}}>
						<a href="{{route('admin.meta')}}"><i class="fa fa-key"></i> <span class="nav-label">Meta</span></a>
					</li>
					<li {{(URL::full() == route('admin.settings'))? "class=active" : null}}>
						<a href="{{route('admin.settings')}}"><i class="fa fa-cog"></i> <span class="nav-label">Nustatymai</span></a>
					</li>
				</ul>

			</div>
		</nav>
		<div id="page-wrapper" class="gray-bg dashbard-1">
		<div class="row border-bottom">
			<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
			</div>
			<ul class="nav navbar-top-links navbar-right">
				<li>
					<a target="_blank" href="{{route('main.page')}}">
						<i class="fa fa-home"></i> Titulinis
					</a>
				</li>
				<li>
					<a href="{{route('main.logout')}}">
						<i class="fa fa-sign-out"></i> Log out
					</a>
				</li>

			</ul>
			</nav>
		</div>
	<div class="wrapper wrapper-content">
		@yield('content')
    </div>
	<div class="footer">               
		<div>
			<strong>Copyright</strong>
		</div>
	</div>
	</div>
	</div>

    <script src="{{asset('admin/js/bootstrap.min.js') }}"></script>
	<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script src="//cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js'></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
	<script src="{{asset('admin/js/jquery.metisMenu.js') }}"></script>
	<script src="{{asset('admin/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{asset('admin/js/pace.min.js') }}"></script>
	<script src="{{asset('admin/js/jquery-ui.min.js') }}"></script>
	<script src="{{asset('admin/js/Chart.min.js') }}"></script>
	<script src="{{asset('admin/js/switchery.min.js') }}"></script>


	<script src="{{asset('admin/js/inspinia.js') }}"></script>
	<script src="{{asset('admin/js/main.js') }}"></script>
	@yield('script')
    </body>
</html>
