<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">

  <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">

    <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>

    <!-- Menampilkan error -->
    @if(session('error'))
    <script>
    Swal.fire({
      icon: 'error',
      title: 'Gagal!',
      text: "{{ session('error') }}",
    });
    </script>
    @endif

    @if(session('success'))
    <script>
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: "{{ session('success') }}",
    });
    </script>
    @endif

    <form action="{{ route('user.login') }}" method="POST">
      @csrf
      <div class="mb-4">
        <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
        <input type="text" name="nip" id="nip" required
          class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none">
      </div>

      <div class="mb-6">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" id="password" required
          class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none">
      </div>

      <button type="submit"
        class="w-full py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
        Login
      </button>

    </form>

  </div>

</body>

</html>