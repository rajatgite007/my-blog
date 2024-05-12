<header id="page-topbar" style="left: 0;">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
            </div>
            <div class="d-flex align-items-center">
                <a href="{{ route('public.posts') }}" style="margin-right: 15px;">Post</a> 
                @auth
                    <a href="{{ route('admin.posts') }}">Admin</a>
                @endauth
            </div>
        </div>
    </div>
</header>