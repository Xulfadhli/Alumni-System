@extends('layouts.app') <!-- Extend the app.blade.php file -->
@section('content') <!-- Start the content section -->
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div> --}}
            <div class="bg-white border rounded shadow p-4">
              <div class="border-b p-2">
                <!-- Header content goes here -->
                List of all reports
              </div>
              <div class="p-2">
                <!-- Body content goes here -->
                @if(Session::has('message'))
                  <div class="bg-green-500 text-white px-4 py-2 rounded">
                    <!-- Alert content goes here -->
                    {{ Session::get('message') }}
                  </div>
                @endif
                <div class="p-2"><a href="{{ route('admin.report-list') }}" 
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">New Report</a></div>
                
                <div class="flex flex-col">
                  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 w-full">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                      <div class="overflow-hidden">
                        <table class="min-w-full text-left text-sm font-light">
                          <thead
                            class="border-b font-medium dark:border-neutral-500">
                            <tr>
                              <!--<th scope="col" class="px-6 py-4">#</th>-->
                              <th scope="col" class="px-6 py-4">Report ID</th>
                              <th scope="col" class="px-6 py-4">Title</th>
                              <th scope="col" class="px-6 py-4">Alumni ID</th>
                              <th scope="col" class="px-6 py-4">Content</th>
                              <th scope="col" class="px-6 py-4">Summary</th>                              
                              <th scope="col" class="px-6 py-4">Data Source</th>
                              <th scope="col" class="px-6 py-4">Version</th>
                              <th scope="col" class="px-6 py-4">Timestamps</th>
                              <!--<th scope="col" class="px-6 py-4">Time</th>
                              <th scope="col" class="px-6 py-4">Place</th>
                              <th scope="col" class="px-6 py-4">Capacity</th>
                              <th scope="col" class="px-6 py-4">Duration</th>
                              <th scope="col" class="px-6 py-4">Status</th>-->
                            </tr>
                          </thead>
                          <tbody>
                            @php($i=0)
                            @foreach($reports as $reports)
                            <tr
                              class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600">
                              <td class="whitespace-nowrap px-6 py-4 font-medium">{{ ++$i }}</td>
                              <td class="whitespace-nowrap px-6 py-4">{{ $reports->report_id }}</td>
                              <td class="whitespace-nowrap px-6 py-4">{{ $reports->title }}</td>
                              <!--<td class="whitespace-nowrap px-6 py-4">{{ $events->trainer }}</td>-->
                              <td class="whitespace-nowrap px-6 py-4">
                                @if ($reports->photo)
                                  <img src="{{ asset('images/reports/' . $reports->alumni_id) }}" alt="">
                                @else
                                  <img src="{{ asset('images/reports/default.jpg') }}" alt="">
                                @endif
                              </td>
                              <td class="whitespace-nowrap px-6 py-4">{{ $reports->content }}</td>
                              <td class="whitespace-nowrap px-6 py-4">{{ $reports->summary }}</td>
                              <td class="whitespace-nowrap px-6 py-4">{{ $reports->data_source }}</td>
                              <td class="whitespace-nowrap px-6 py-4">{{ $reports->version }}</td>
                              <td class="whitespace-nowrap px-6 py-4">{{ $reports->timestamps }}</td>
                              <!--<td class="whitespace-nowrap px-6 py-4">{{ $events->duration }}</td>
                              <td class="whitespace-nowrap px-6 py-4">{{ $events->status }}</td>-->
                              <td class="whitespace-nowrap px-6 py-4">
                                
                                <form method="post" action="{{ route('admin.delete-report',$reports->id) }}">
                                  <input type="hidden" name="_method" value="DELETE">
                                  @csrf
                                  <a href="{{ route('admin.edit-report-form',$reports->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Edit</a>
                                  <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Delete</button>
                                </form>

                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection <!-- End the content section -->