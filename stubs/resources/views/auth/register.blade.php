{{-- resources/views/auth/register.blade.php --}}
<x-layouts.app :title="'Register'">
  <form method="POST" action="{{ route('register') }}" class="max-w-md mx-auto space-y-4">
    @csrf
    <div>
      <label class="block text-sm font-medium">Name</label>
      <input type="text" name="name" required class="mt-1 w-full rounded border px-3 py-2" value="{{ old('name') }}">
      @error('name') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
      <label class="block text-sm font-medium">Email</label>
      <input type="email" name="email" required class="mt-1 w-full rounded border px-3 py-2" value="{{ old('email') }}">
      @error('email') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
      <label class="block text-sm font-medium">Password</label>
      <input type="password" name="password" required class="mt-1 w-full rounded border px-3 py-2">
      @error('password') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
      <label class="block text-sm font-medium">Confirm Password</label>
      <input type="password" name="password_confirmation" required class="mt-1 w-full rounded border px-3 py-2">
    </div>
    <button class="mt-2 rounded bg-indigo-600 px-4 py-2 text-white">Register</button>
  </form>
</x-layouts.app>
