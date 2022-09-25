@extends('main')

@section('title','Edit Score')


@section('content')
<div>
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Edit Score</h3>
        <p class="mt-1 text-sm text-gray-600">Edit Score on this form</p>
        <a href="{{ route('student.index') }}" class="inline-flex items-center mt-4 py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          Go Back
        </a>
      </div>
    </div>
    <div class="mt-5 md:col-span-2 md:mt-0">
      
      <form action="{{ route('score.update',$score) }}" method="POST">
        @csrf @method('put')
        <div class="mb-6">
          <div class="mb-6">
            <label for="student_name" class="block mb-2 text-sm font-medium text-gray-900">Student Name</label>
            <input type="text" id="student_name" value="{{ $score->student->name }}" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
          </div>

          <div class="mb-6">
            <label for="quiz" class="block mb-2 text-sm font-medium text-gray-900">Quiz</label>
            <input type="number" name="quiz" id="quiz" value="{{ $score->quiz }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="100" required>
          </div>

          <div class="mb-6">
            <label for="task" class="block mb-2 text-sm font-medium text-gray-900">Task</label>
            <input type="number" name="task" id="task" value="{{ $score->task }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="100" required>
          </div>

          <div class="mb-6">
            <label for="attendance" class="block mb-2 text-sm font-medium text-gray-900">Attendance</label>
            <input type="number" name="attendance" id="attendance" value="{{ $score->attendance }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="100" required>
          </div>

          <div class="mb-6">
            <label for="practice" class="block mb-2 text-sm font-medium text-gray-900">Practice</label>
            <input type="number" name="practice" id="practice" value="{{ $score->practice }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="100" required>
          </div>

          <div class="mb-6">
            <label for="final_test" class="block mb-2 text-sm font-medium text-gray-900">Final Test</label>
            <input type="number" name="final_test" id="final_test" value="{{ $score->final_test }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="100" required>
          </div>
          </div>
          <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
      </form>
      @if ($errors->any())
        @foreach ($errors->all() as $error)
          <div class="flex p-4 my-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Info</span>
            <div>
              <span class="font-medium">Danger alert!</span> {{$error}}
            </div>
          </div>
        @endforeach
      @endif
    </div>
  </div>
</div>

@endsection