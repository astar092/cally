<div class="ui fixed huge top-menu menu">
	<div class="logo-item item">
	    <div class="ui logo icon image">
			<img src="{{ asset('/images/logo.png') }}">
	    </div>
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
		<div class="item">
            <div class="menu">
                <div class="header">{{__('Administration')}}</div>
                @can('view-users')
                    <a class="item {{(Route::currentRouteName() == 'admin.users') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                        {{__('user.Users')}}
                    </a>
                @endcan
                @can('view-roles')
                    <a class="item {{(Route::currentRouteName() == 'admin.userroles') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">
                        {{__('user.User Roles')}}
                    </a>
                @endcan
            </div>
        </div>
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
	
	<div class="change-language js-change-language">
		<i class="globe icon"></i>
	</div>
	<div class="change-language-select-block hidden">
		<div class="form-group">
			<select class="ui dropdown">
				<option value="ru" @if(Config::get('app.locale') == "ru") selected @endif>RU</option>
				<option value="kg" @if(Config::get('app.locale') == "kg") selected @endif>KG</option>
			</select>
		</div>
	</div>
</div>
