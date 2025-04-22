@extends('layouts.admin')
@section('title', 'Payment Hold')
@push('styles')
<style>
    .status-badge {
      font-size: 0.85rem;
    }
    .table-actions i {
      cursor: pointer;
      margin: 0 5px;
    }
  </style>
@endpush

@section('content')

                    <h3 class="mb-4">💰 Admin Payment Holder Page</h3>

                    <!-- Filters -->
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <form class="form-inline">
                                <label class="mr-2">Owner:</label>
                                <input type="text" class="form-control mr-4" placeholder="Owner Name">
                                <label class="mr-2">Status:</label>
                                <select class="form-control mr-4">
                                    <option>All</option>
                                    <option>Payment Hold</option>
                                    <option>Released</option>
                                    <option>Disputed</option>
                                </select>
                                <label class="mr-2">Date Range:</label>
                                <input type="date" class="form-control mr-2">
                                <input type="date" class="form-control mr-2">
                                <button class="btn btn-primary">Search</button>
                            </form>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Payout Holding Table</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Payout ID</th>
                                        <th>Booking ID</th>
                                        <th>Room Title</th>
                                        <th>Owner</th>
                                        <th>Booking Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#P001</td>
                                        <td>#B145</td>
                                        <td>Flat A203</td>
                                        <td>Ravi Singh</td>
                                        <td>2025-04-05</td>
                                        <td>₹4500</td>
                                        <td><span class="badge badge-warning status-badge">Payment Hold</span></td>
                                        <td class="table-actions">
                                            <i class="fas fa-eye text-info" title="View Details"></i>
                                            <i class="fas fa-check-circle text-success" title="Release Payment"></i>
                                            <i class="fas fa-ban text-danger" title="Mark as Disputed"></i>
                                            <i class="fas fa-file-download text-primary" title="Download Receipt"></i>
                                        </td>
                                    </tr>
                                    <!-- More rows -->
                                </tbody>
                            </table>
                        </div>
                    </div>

          
@endsection
@push('scripts')
<script>
    $(document).on('click', '.fa-check-circle', function() {
      if (confirm("Are you sure you want to release this payment? This action cannot be undone.")) {
        alert("Payment released successfully!");
      }
    });
  
    $(document).on('click', '.fa-ban', function() {
      let reason = prompt("Enter reason for dispute/hold:");
      if (reason) {
        alert("Marked as Disputed: " + reason);
      }
    });
  </script>
    
@endpush
