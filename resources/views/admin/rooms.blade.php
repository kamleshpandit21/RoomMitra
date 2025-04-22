@extends('layouts.admin')
@section('title', 'Manage Rooms')
@push('styles')
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>🏠 Pending Room Approvals</h5>
            <div>
                <input type="text" class="form-control d-inline-block w-auto" placeholder="Search by Owner or City">
            </div>
        </div>
        <div class="card-body">
            <!-- Filters -->
            <div class="row mb-3">
                <div class="col-md-3 form-group">
                    <select class="form-control  select2bs4">
                        <option value="">Filter by City</option>
                        <option>Noida</option>
                        <option>Delhi</option>
                        <!-- More cities -->
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <select class="form-control  select2bs4">
                        <option>Status</option>
                        <option>Pending</option>
                        <option>Approved</option>
                        <option>Rejected</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" placeholder="From Date">
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" placeholder="To Date">
                </div>
            </div>

            <!-- Room Listing Table -->
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Room ID</th>
                        <th>Title</th>
                        <th>Owner Name</th>
                        <th>City / Locality</th>
                        <th>Submitted On</th>
                        <th>Status</th>
                        <th>Verified</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rooms as $room)
                        <tr>
                            <td>#{{ $room->room_id }}</td>
                            <td>{{ ucwords($room->room_title) }}</td>
                            <td>{{ $room->owner ? ucwords($room->owner->full_name) : 'N/A' }}</td>
                            <td>{{ ucwords($room->city) }}, {{ ucwords($room->locality) }}</td>
                            <td>{{ $room->created_at }}</td>
                            <td><span
                                    class="badge badge-{{ $room->status === 'available' ? 'success' : ($room->status === 'booked' ? 'warning' : ($room->status === 'pending' ? 'info' : 'secondary')) }}">{{ $room->status === 'available' ? 'Available' : ($room->status === 'booked' ? 'Booked' : ($room->status === 'pending' ? 'Pending' : 'Inactive')) }}</span>
                            </td>
                            <td><span
                                    class="badge badge-{{ $room->is_verified == true ? 'success' : 'secondary' }}">{{ $room->is_verified === true ? 'Yes' : 'No' }}</span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-info view-room-btn" id="viewRoomBtn"
                                    data-id="{{ $room->room_id }}">👁️
                                    View</button>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No Rooms Found</td>
                        </tr>
                    @endforelse

                    <!-- More rows -->
                </tbody>
            </table>
            <div class="mt-3">
                {{ $rooms->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="viewRoomModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4">Room Details - Flat A203</h5>
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="https://via.placeholder.com/300" class="room-img mb-2" alt="Room">
                            <p><strong>Rent:</strong> ₹4500 | <strong>Deposit:</strong> ₹2000</p>
                            <p><strong>Sharing:</strong> Double | <strong>Beds:</strong> 2</p>
                        </div>
                        <div class="col-md-4">
                            <h6>Specifications</h6>
                            <ul>
                                <li>Lift: Yes</li>
                                <li>Parking: Available</li>
                                <li>Light: 24x7</li>
                                <li>Bathroom: Western</li>
                            </ul>
                            <h6>Amenities</h6>
                            <ul>
                                <li>WiFi - ₹100</li>
                                <li>RO - Free</li>
                                <li>Refrigerator - ₹150</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h6>Location</h6>
                            <p>Rajouri Garden, Delhi</p>
                            <p><strong>Landmark:</strong> Near Metro Station</p>
                            <h6>Restrictions</h6>
                            <p>No Smoking, No Pets</p>
                            <h6>Owner Info</h6>
                            <p>Rohit Kumar<br>📞 9876543210</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" data-toggle="modal" data-target="#approveRoomModal">Approve</button>
                    <button class="btn btn-danger" data-dismiss="modal" data-toggle="modal"
                        data-target="#rejectModal">Reject</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
 
    <div class="modal fade" id="approveRoomModal" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5>✔️ Approve Room</h5>
                    <button class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to approve this room?</p>
                    <div class="form-group">
                        <label>Optional internal note</label>
                        <textarea class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Approve</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="rejectRoomModal" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5>❌ Reject Room</h5>
                    <button class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <p>Please provide a reason for rejection:</p>
                    <textarea class="form-control" required rows="3" placeholder="Enter rejection reason"></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger">Reject</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header">
            <h5>🕒 Recent Approval Activity</h5>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">
                    ✔️ Room <strong>#RM4567</strong> approved by <strong>Admin1</strong> on 12-Apr-2025
                </li>
                <li class="list-group-item">
                    ❌ Room <strong>#RM4568</strong> rejected by <strong>Admin2</strong> on 11-Apr-2025 – Reason: Incomplete
                    images
                </li>
                <!-- More logs -->
            </ul>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Attach event to all buttons with the class 'view-room-btn'
            document.querySelectorAll('.view-room-btn').forEach(button => {
                button.addEventListener('click', (event) => {
                    const roomId = event.currentTarget.getAttribute('data-id');
                    window.location.href = '{{ route('admin.rooms.show', ':id') }}'.replace(':id',
                        roomId);
                });
            });
        });
    </script>
@endpush
