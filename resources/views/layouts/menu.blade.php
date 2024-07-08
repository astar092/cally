<div class="ui fixed huge top-menu menu">
	<div class="logo-item item">
	    {{-- <div class="ui logo icon image">
			<img src="{{ asset('/images/logo.png') }}">
	    </div> --}}
	    <div class="agriculture-title">
			<a href="">{{ config('app.name', 'Sample project') }}</a>
	    </div>
		<a class="launch icon" href="#">
			<i class="content icon"></i>
		</a>
	</div>
	@if (isset($page_title))
		<div class="page-title item">
			{{$page_title}}
		</div>
	@endif
</div>
<div class="ui vertical sidebar menu left">
	@guest
	@else
		@canany(['view-users', 'view-roles'])
			<div class="parent-item">
				<input class="parent-input" type="checkbox" id="1">
				<label class="parent-title" for="1">{{__('Administration')}}</label>

				<div class="child-text">
					@can('view-users')
						<a class="item {{(Route::currentRouteName() == 'admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
							{{__('user.Users')}}
						</a>
					@endcan
					@can('view-roles')
						<a class="item {{(Route::currentRouteName() == 'admin.userroles.index') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">
							{{__('user.User Roles')}}
						</a>
					@endcan
				</div>
			</div>
		@endcanany

		@can('view-applications')
			<div class="parent-item">
				<a class="parent-link {{(Route::currentRouteName() == 'admin.applications.index') ? 'active' : '' }}" href="{{ route('admin.applications.index') }}">
					{{__('application.Applications')}}
				</a>
			</div>
		@endcan
	@endguest
</div>

<div class="authentication-links">
	@guest
		<a class="item stick-bottom" href="{{ route('login') }}"><i class="lock icon"></i> {{ __('Login') }}</a>
	@else
		<a class="item stick-bottom" href="{{ route('logout') }}">
			<i class="unlock icon"></i> {{ __('Logout') }}
		</a>

		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			@csrf
		</form>
	@endguest
</div>
