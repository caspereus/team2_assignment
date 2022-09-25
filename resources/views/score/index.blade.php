@extends('main')

@section('title','Scores')


@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
<div class="bg-white">
  <div class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Scores</h2>
    <a href="{{ route('score.create') }}" class="inline-flex items-center mt-4 py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
      Create Score
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
    
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg mt-6">
        <canvas id="canvas_barchart" height="280" width="600"></canvas>
        <div class="mt-8">
        <canvas id="canvas_piechart" height="280" width="600"></canvas>
        </div>

        <table class="w-full text-sm text-left text-gray-500 mt-6">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        No
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Quiz
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Attendance
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Practice
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Final Test
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Average
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Grade
                    </th>
                    <th scope="col" class="py-3 px-6">
                        <span class="sr-only"></span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($scores as $score)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                        {{ $loop->index + 1 }}
                    </th>
                    <td class="py-4 px-6">
                        {{ $score->student->name }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $score->quiz }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $score->attendance }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $score->practice }}
                    </td>
                    <td class="py-4 px-6">
                      {{ $score->final_test }}
                    </td>
                    <td class="py-4 px-6">
                      {{ $score->average() }}
                    </td>
                    <td class="py-4 px-6">
                      {{ $score->grade() }}
                    </td>
                    <td class="py-4 px-6 text-right">
                    <a href="{{ route('score.edit',$score) }}" class="inline-flex items-center mt-4 py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                      Edit
                    </a>
                    <form method="post" action="{{route('score.destroy',$score)}}">
                        @method('delete')
                        @csrf
                        <button type="submit" class="inline-flex items-center mt-4 py-2 px-3 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">Delete</button>
                    </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
</div>
<script>
    const scoreApiURL = "{{ url('api/scores') }}";
    let averages = new Array();
    let grades = new Array();
    let students = new Array();
    let gradeMap = new Map();
    gradeMap.set('A',0);
    gradeMap.set('B',0);
    gradeMap.set('C',0);
    gradeMap.set('D',0);
    $(document).ready(function(){
        $.get(scoreApiURL, function(response){
            response.forEach(function(data){
                averages.push(data.average);
                grades.push(data.grade);
                students.push(data.student.name);
                if(gradeMap.has(data.grade)){
                    gradeMap.set(data.grade,gradeMap.get(data.grade) + 1);
                }
            });
            const barChartContext = document.getElementById("canvas_barchart").getContext('2d');
            const pieChartContext = document.getElementById("canvas_piechart").getContext('2d');
            const barChart = new Chart(barChartContext, {
                type: 'bar',
                data: {
                    labels: students,
                    datasets: [{
                        label: 'Rata - Rata nilai',
                        data: averages,
                        borderWidth: 1
                    }]
                },
            });
            const pieChart = new Chart(pieChartContext, {
                type: 'pie',
                data: {
                    labels: Array.from(gradeMap.keys()),
                    datasets: [{
                        label: 'Grade Siswa',
                        data: Array.from(gradeMap.values()),
                        backgroundColor: [
                            'green',
                            'blue',
                            'yellow',
                            'red',
                        ],
                        borderWidth: 1
                    }]
                },
            });
        });
    });
</script>

@endsection