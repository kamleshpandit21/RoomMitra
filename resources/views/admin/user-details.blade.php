@extends('layouts.admin')

@section('title', 'User Details')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
    <div class="container py-4">
      
        <div class="row g-4">
            <!-- Left Column - Basic Info -->
            <div class="col-lg-4">
                <div class="card shadow rounded-4">
                    <div class="card-body text-center">
                        <img src="{{ $user->profile->avatar ?? asset('images/default-avatar.png') }}"
                            class="rounded-circle mb-3" width="120" height="120" alt="User Avatar">
                        <h4 class="mb-0">{{ $user->full_name }}</h4>
                        <p class="text-muted">{{ $user->email }}</p>

                        <span class="badge bg-{{ $user->role === 'room_owner' ? 'warning' : 'primary' }}">
                            <i class="fas fa-user{{ $user->role === 'room_owner' ? '-tie' : '' }}"></i>
                            {{ ucfirst($user->role) }}
                        </span>

                        <div class="mt-3">
                            @if ($user->is_verified)
                                <span class="badge bg-success"><i class="fas fa-check-circle"></i> Verified</span>
                            @else
                                <span class="badge bg-secondary"><i class="fas fa-times-circle"></i> Not Verified</span>
                            @endif

                            @if ($user->is_blocked)
                                <span class="badge bg-danger"><i class="fas fa-ban"></i> Blocked</span>
                            @endif
                        </div>

                        <hr>
                        <p class="small text-muted mb-0">Joined: {{ $user->created_at->format('d M, Y') }}</p>
                        <!-- Admin Actions -->
                        <div class="d-flex justify-content-end">
                            @if (!$user->is_verified)
                                <form method="POST" action="{{ route('admin.users.verify', $user->user_id) }}"
                                    class="me-2">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-success" title="Verify User">
                                        <i class="fas fa-check-circle"></i> Verify
                                    </button>
                                </form>
                            @endif

                            @if (!$user->is_blocked)
                                <form method="POST" action="{{ route('admin.users.block', $user->user_id) }}"
                                    class="me-2">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Block User">
                                        <i class="fas fa-ban"></i> Block
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.users.unblock', $user->user_id) }}"
                                    class="me-2">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-warning" title="Unblock User">
                                        <i class="fas fa-unlock-alt"></i> Unblock
                                    </button>
                                </form>
                            @endif

                            <form method="POST" action="{{ route('admin.users.destroy', $user->user_id) }}"
                                onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-dark" title="Delete User">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Right Column - Detailed Info -->
            <div class="col-lg-8">
                <div class="card shadow rounded-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3"><i class="fas fa-id-card me-2"></i>Profile Information</h5>

                        <div class="row mb-3">
                            <div class="col-md-6"><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</div>
                            <div class="col-md-6"><strong>DOB:</strong>
                                {{ optional($user->profile)->date_of_birth ?? 'N/A' }}</div>
                            <div class="col-md-6"><strong>Gender:</strong> {{ optional($user->profile)->gender ?? 'N/A' }}
                            </div>
                            <div class="col-md-6"><strong>Aadhar:</strong> {{ optional($user->profile)->aadhar ?? 'N/A' }}
                            </div>
                            <div class="col-md-6"><strong>College:</strong>
                                {{ optional($user->profile)->college_name ?? 'N/A' }}</div>
                            <div class="col-md-6"><strong>Course/Year:</strong>
                                {{ optional($user->profile)->course ?? '' }} /
                                {{ optional($user->profile)->study_year ?? 'N/A' }}</div>
                        </div>

                        <h6 class="text-muted mt-4"><i class="fas fa-map-marker-alt me-2"></i>Address Info</h6>
                        <div class="row mb-3">
                            <div class="col-md-6"><strong>Current:</strong> {{ $user->profile->current_address ?? 'N/A' }}
                            </div>
                            <div class="col-md-6"><strong>Permanent:</strong>
                                {{ $user->profile->permanent_address ?? 'N/A' }}</div>
                            <div class="col-md-4"><strong>City:</strong> {{ $user->profile->city ?? 'N/A' }}</div>
                            <div class="col-md-4"><strong>State:</strong> {{ $user->profile->state ?? 'N/A' }}</div>
                            <div class="col-md-4"><strong>Pincode:</strong> {{ $user->profile->pincode ?? 'N/A' }}</div>
                        </div>

                        @if ($user->profile->bio)
                            <div class="mt-4">
                                <h6><i class="fas fa-info-circle me-2"></i>Bio</h6>
                                <p class="fst-italic">{{ $user->profile->bio }}</p>
                            </div>
                        @endif

                        @if ($user->profile->social_links)
                            <div class="mt-4">
                                <h6><i class="fas fa-share-alt me-2"></i>Social Links</h6>
                                <ul class="list-unstyled">
                                    @foreach (json_decode($user->profile->social_links, true) as $platform => $url)
                                        <li>
                                            <i class="fab fa-{{ strtolower($platform) }}"></i>
                                            <a href="{{ $url }}" target="_blank">{{ ucfirst($platform) }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($user->profile->id_card_url)
                            <div class="mt-4">
                                <h6><i class="fas fa-id-badge me-2"></i>ID Card</h6>
                                <a href="{{ asset($user->profile->id_card_url) }}" target="_blank"
                                    class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-eye me-1"></i> View ID Card
                                </a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
