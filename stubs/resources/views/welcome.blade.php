{{-- resources/views/welcome.blade.php --}}
<x-layouts.app :title="'Welcome'">
  <h1 class="text-2xl font-bold">Welcome</h1>
  <p class="mt-2">The stacked header component is active.</p>
  @guest
    <p class="mt-4"><a href="{{ route('register') }}" class="text-indigo-600 underline">Create an account</a> to explore the dashboard.</p>
  @endguest
</x-layouts.app>
