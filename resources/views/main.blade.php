<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <div class="min-h-full">
    <nav class="bg-gray-800">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                <a href="{{ route('video.index')}}" class="text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">TK 1 - Video</a>
                <a href="{{ route('student.index') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">TK 2 - Student</a>
                <a href="{{ route('score.index') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">TK 2 - Score</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <main>
      <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <!-- Replace with your content -->
        <div class="px-4 sm:px-0">
          @yield('content')
        </div>
        <!-- /End replace -->
      </div>
    </main>
  </div>

</body>
@yield('script')
</html>