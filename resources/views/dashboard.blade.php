<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
            Welcome <b>{{ Auth::user()->name }}!</b>
            <b style="float: right;">Total users: <span class="badge badge-danger">{{ count($users) }}</span></b>
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> --}}
                {{-- <x-welcome /> --}}
                <div class="container">
                    <div class="row">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Created at</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($users as $user)
                              <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            {{-- </div> --}}
        </div>
    </div>
</x-app-layout>
