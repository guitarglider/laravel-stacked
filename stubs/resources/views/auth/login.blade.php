{{-- resources/views/auth/login.blade.php --}}
<x-layouts.app :title="'Login'">
  <form method="POST" action="{{ route('login') }}" class="max-w-md mx-auto space-y-4">
    @csrf
    <div>
      <label class="block text-sm font-medium">Email</label>
      <input type="email" name="email" required class="mt-1 w-full rounded border px-3 py-2">
      @error('email') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
      <label class="block text-sm font-medium">Password</label>
      <input type="password" name="password" required class="mt-1 w-full rounded border px-3 py-2">
      @error('password') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div class="flex items-center justify-between">
      <label class="inline-flex items-center gap-2">
        <input type="checkbox" name="remember">
        <span>Remember me</span>
      </label>
      <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">Forgot password?</a>
    </div>
    <button class="mt-2 rounded bg-indigo-600 px-4 py-2 text-white">Login</button>
  </form>
</x-layouts.app>
