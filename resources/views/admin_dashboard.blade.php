@extends('layouts.app')

@section('content')
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- DataTables JavaScript -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>{{ __('Dashboard') }}</span>
                <div>
                @if (Auth::user()->profile_image)
                    <img src="{{ asset('storage/images/profile/' . Auth::user()->profile_image) }}" alt="Profile Image" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                @else
                    <!-- Placeholder image or default avatar -->
                    <img src="{{ asset('path_to_default_avatar_image') }}" alt="Profile Image" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                @endif

                </div>
            </div>


                <div class="card-body">
                <table id="users-table" class="display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th> <!-- Add a column for the type checkbox -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <input type="checkbox" class="type-checkbox" data-user-id="{{ $user->id }}" {{ $user->type == 1 ? 'checked' : '' }}>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <script>
                    $(document).ready(function() {
                        $('#users-table').DataTable();
                    });
                </script>
               <script>
                    $(document).ready(function() {
                        // Function to handle checkbox change event
                        $('#users-table').on('change', '.type-checkbox', function() {
                            var userId = $(this).data('user-id');
                            var type = $(this).is(':checked') ? 1 : 0; // Toggle type value
2
                            // Show confirmation dialog
                            if (confirm('Are you sure you want to update this user\'s type?')) {
                                // If user confirms, send AJAX request
                                $.ajax({
                                    type: 'POST',
                                    url: '/update-type/' + userId,
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        type: type
                                    },
                                    success: function(response) {
                                        // Reload the page upon successful update
                                        location.reload();
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(error);
                                        // Handle error if needed
                                    }
                                });
                            }
                        });
                    });
                </script>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
