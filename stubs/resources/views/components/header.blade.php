<header class="navbar bg-base-100 shadow">
  <div class="flex-1">
    <a href="/" class="btn btn-ghost text-xl">{{ config('app.name') }}</a>
  </div>
  <div class="flex-none">
    @auth
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-sm">Logout</button>
      </form>
    @else
      <a class="btn btn-sm mr-2" href="{{ route('login') }}">Login</a>
      <a class="btn btn-sm btn-primary" href="{{ route('register') }}">Register</a>
    @endauth
  </div>
</header>
