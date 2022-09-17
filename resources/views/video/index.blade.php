@extends('main')

@section('title','Videos')


@section('content')

<div class="bg-white">
  <div class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Videos</h2>
    <a href="{{ route('video.create') }}" class="inline-flex items-center mt-4 py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
      Create Video
    </a>
    @if(session('message'))
      <div class="flex p-4 my-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
        <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Info</span>
        <div>
          <span class="font-medium">Info alert!</span> {{ session('message') }}
        </div>
      </div>
      @endif
    <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
      @foreach($videos as $video)
      <div class="group relative">
        <div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md">
            <video class="rounded-t-lg" controls>
              <source src="{{ Storage::url($video->path) }}" type="video/mp4">
            </video>
            <div class="px-5 pt-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $video->name }}</h5>
                </a>
            </div>
            <div class="px-5 pb-5">
            <a href="{{ route('video.edit',$video) }}" class="inline-flex items-center mt-4 py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              Edit Video
            </a>
            <form method="post" action="{{route('video.destroy',$video)}}">
                @method('delete')
                @csrf
                <button type="submit" class="inline-flex items-center mt-4 py-2 px-3 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">Delete Video</button>
            </form>
            </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

@endsection