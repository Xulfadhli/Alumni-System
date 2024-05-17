@extends('layouts.app') <!-- Extend the master.blade.php file -->

@section('content') <!-- Start the content section -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border rounded shadow p-4">
              <div class="border-b p-2">
                <!-- Header content goes here -->
                Register event
              </div>
              <div class="p-2">
                <!-- Body content goes here -->
                @if(Session::has('message'))
                  <div class="bg-green-500 text-white px-4 py-2 rounded">
                    <!-- Alert content goes here -->
                    {{ Session::get('message') }}
                  </div>
                @endif
                <form method="post" action="{{ route('user.register-event') }}" enctype="multipart/form-data">
                    <!--<input type="" name="" value=""> to be below @csrf -->
                @csrf
                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                    <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">Event Name</td>
                            <td class="px-6 py-4">
                                <input type="text" name="name" value="{{ old('name', $event->name) }}" class="p-2 border rounded-md w-full" readonly>
                                @error('name')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <!-- ... similar for other rows ... -->
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">Description</td>
                            <td class="px-6 py-4">
                                <textarea name="description" rows="4" class="p-2 border rounded-md w-full" readonly>{{ old('description', $event->description) }}</textarea>
                                @error('description')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>                    
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">Moderator</td>
                            <td class="px-6 py-4">
                                <input type="text" name="trainer" value="{{ old('trainer', $event->trainer) }}" class="p-2 border rounded-md w-full" readonly>
                                @error('trainer')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">Price</td>
                            <td class="px-6 py-4">
                                <input type="number" name="price" value="{{ old('price', $event->price) }}" class="p-2 border rounded-md w-full" min="0.00" max="10000.00" step="0.01" readonly>
                                @error('price')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">Date</td>
                            <td class="px-6 py-4">
                                <input type="date" name="date" value="{{ old('date', $event->date) }}" class="p-2 border rounded-md w-full" readonly>
                                @error('date')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">Time</td>
                            <td class="px-6 py-4">
                                <input type="time" name="time" value="{{ old('time', $event->time) }}" class="p-2 border rounded-md w-full" readonly>
                                @error('time')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">Place</td>
                            <td class="px-6 py-4">
                                <input type="text" name="place" value="{{ old('place', $event->place) }}" class="p-2 border rounded-md w-full" readonly>
                                @error('place')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                          <td class="px-6 py-4 whitespace-nowrap">Proof of Payment<br>(JPEG,JPG,PNG,PDF)</td>
                          <td class="px-6 py-4">
                              <input type="file" name="proofofpayment" class="p-2 border rounded-md w-full">
                              @error('proofofpayment')
                                  <span class="text-red-500">{{ $message }}</span>
                              @enderror
                          </td>
                      </tr>
                        <tr>
                            <td class="px-6 py-4"></td>
                            <td class="px-6 py-4">
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                                    Register
                                </button>
                                
                                <button onclick="event.preventDefault(); location.href='{{ route('user.event-list') }}';" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                                    Cancel
                                </button>
                                
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </form>

              </div>
            </div>
        </div>
    </div>
@endsection <!-- End the content section -->