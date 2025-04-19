@extends('admin.layout.master')
@section('title', 'Manage Complaints')
@push('styles')
    
@endpush

@section('content')
<div class="row mb-3">
    <div class="col-md-3">
      <input type="text" class="form-control" placeholder="Search by keyword or Room ID">
    </div>
    <div class="col-md-2 form-group">
      <select class="form-control form-select">
        <option value="">Status</option>
        <option>Open</option>
        <option>In Progress</option>
        <option>Resolved</option>
        <option>Closed</option>
      </select>
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control" placeholder="User/Owner Name">
    </div>
    <div class="col-md-3">
      <input type="date" class="form-control" placeholder="Date From">
    </div>
    <div class="col-md-2">
      <button class="btn btn-primary w-100">🔍 Filter</button>
    </div>
  </div>
  <div class="dropdown mb-3">
    <button class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown">📤 Export</button>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#">Export as CSV</a></li>
      <li><a class="dropdown-item" href="#">Export as PDF</a></li>
    </ul>
  </div>
  
<table class="table table-hover align-middle">
    <thead class="thead-light">
      <tr>
        <th>ID</th>
        <th>From</th>
        <th>Category</th>
        <th>Subject</th>
        <th>Status</th>
        <th>Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse ( $complaints as $Complaint )
      
      <tr>
        <td>{{ $Complaint->id }}</td>
        <td>
          <strong>{{ $Complaint->name }}</strong><br>
          <small>{{ $Complaint->email }}</small><br>
          <span class="badge {{ $Complaint->user_type == 'Owner' ? 'bg-success text-dark' : 'bg-info text-dark' }}">{{ $Complaint->user_type }}</span>
        </td>
        <td>
          {{ $Complaint->category }}<br>
        </td>
        <td>{{ $Complaint->subject }}</td>
        <td><span class="badge bg-danger">{{ $Complaint->status }}</span></td>
        <td>{{ $Complaint->created_at }}</td>
        <td>
          <button class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#viewComplaintModal">👁️</button>
          <button class="btn btn-sm btn-outline-success">✅</button>
          <button class="btn btn-sm btn-outline-danger">🗑️</button>
        </td>
      </tr>
          
      @empty
          
      @endforelse
    
    </tbody>
  </table>

  <div class="modal fade" id="viewComplaintModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Complaint #CMP123</h5>
          <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
          <h6>Subject: Noise Issue at night</h6>
          <p><strong>Description:</strong> Loud noise from other tenants after 10pm every day...</p>
  
          <hr>
          <h6>User Info</h6>
          <p>Name: Ravi Kumar <br>Email: ravi@example.com <br>Role: User</p>
  
          <h6>Room Info</h6>
          <p>Room ID: #RM456<br>Title: Spacious Room in Noida Sector 62</p>
  
          <h6>Attachments:</h6>
          <a href="#" target="_blank">noise_recording.mp3</a>
  
          <hr>
          <h6>Reply / Notes</h6>
          <textarea class="form-control mb-2" placeholder="Write your reply or note..."></textarea>
          <input type="file" class="form-control mb-2">
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="internalNote">
            <label class="form-check-label" for="internalNote">Mark as Internal Note</label>
          </div>
          <button class="btn btn-success">💬 Send Reply</button>
          <button class="btn btn-outline-secondary">✅ Mark as Resolved</button>
        </div>
      </div>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-md-3">
      <div class="card bg-light shadow-sm text-center p-3">
        <h6>Total Complaints</h6>
        <h4>124</h4>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-danger text-white text-center p-3">
        <h6>Open</h6>
        <h4>38</h4>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-success text-white text-center p-3">
        <h6>Resolved</h6>
        <h4>72</h4>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-info text-white text-center p-3">
        <h6>This Week</h6>
        <h4>14</h4>
      </div>
    </div>
  </div>
    
@endsection