@extends('admin.layout')
@section('admin')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
                <div>
                    <i class="fas fa-cog fa-2x text-primary me-3"></i>
                    <div>
                        <h2 class="mb-1 fw-bold">Settings & Control Panel</h2>
                        <p class="text-muted mb-0">Manage profile, system settings & account security</p>
                    </div>
                </div>
                <div class="profile-widget me-3">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-2">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold small">Admin User</div>
                            <small class="text-muted">admin@care.com</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Profile Management --}}
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card h-100 widget-card hover-card" data-bs-toggle="modal" data-bs-target="#profileModal">
                <div class="card-body text-center p-4">
                    <div class="widget-icon bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-user-circle fa-xl text-primary"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-2">My Profile</h6>
                    <p class="text-muted small mb-0">Update personal info & photo</p>
                </div>
            </div>
        </div>

        {{-- Basic Settings --}}
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card h-100 widget-card hover-card" data-bs-toggle="modal" data-bs-target="#basicModal">
                <div class="card-body text-center p-4">
                    <div class="widget-icon bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-sliders-h fa-xl text-info"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-2">Site Settings</h6>
                    <p class="text-muted small mb-0">Title, logo & preferences</p>
                </div>
            </div>
        </div>

        {{-- Security --}}
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card h-100 widget-card hover-card" data-bs-toggle="modal" data-bs-target="#securityModal">
                <div class="card-body text-center p-4">
                    <div class="widget-icon bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-shield-alt fa-xl text-success"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-2">Security</h6>
                    <p class="text-muted small mb-0">Password & 2FA settings</p>
                </div>
            </div>
        </div>

        {{-- Notifications --}}
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card h-100 widget-card hover-card" data-bs-toggle="modal" data-bs-target="#notificationModal">
                <div class="card-body text-center p-4">
                    <div class="widget-icon bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-bell fa-xl text-warning"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-2">Notifications</h6>
                    <p class="text-muted small mb-0">Email & SMS alerts</p>
                </div>
            </div>
        </div>

        {{-- Email Settings --}}
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card h-100 widget-card hover-card" data-bs-toggle="modal" data-bs-target="#emailModal">
                <div class="card-body text-center p-4">
                    <div class="widget-icon bg-info bg-opacity-15 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-envelope fa-xl text-info"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-2">Email Config</h6>
                    <p class="text-muted small mb-0">SMTP configuration</p>
                </div>
            </div>
        </div>

        {{-- Activity Logs --}}
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card h-100 widget-card hover-card" data-bs-toggle="modal" data-bs-target="#logsModal">
                <div class="card-body text-center p-4">
                    <div class="widget-icon bg-purple bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-chart-line fa-xl text-purple"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-2">Activity Logs</h6>
                    <p class="text-muted small mb-0">Recent system activities</p>
                </div>
            </div>
        </div>

        {{-- Backup --}}
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card h-100 widget-card hover-card" data-bs-toggle="modal" data-bs-target="#backupModal">
                <div class="card-body text-center p-4">
                    <div class="widget-icon bg-dark bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-database fa-xl text-dark"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-2">Backup</h6>
                    <p class="text-muted small mb-0">Database & files</p>
                </div>
            </div>
        </div>

        {{-- Logout --}}
        <div class="col-xl-3 col-lg-4 col-md-6">
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <button onclick="document.getElementById('logout-form').submit()" 
                    class="card h-100 widget-card hover-card logout-widget text-center p-4" 
                    style="border: none; background: none; width: 100%;">
                <div class="card-body">
                    <div class="widget-icon bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 logout-icon" style="width: 70px; height: 70px;">
                        <i class="fas fa-sign-out-alt fa-xl text-danger"></i>
                    </div>
                    <h6 class="fw-bold text-danger mb-2">Logout</h6>
                    <p class="text-muted small mb-0">Sign out of account</p>
                </div>
            </button>
        </div>
    </div>
</div>

{{-- Profile Modal --}}
<div class="modal fade" id="profileModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-user-circle me-2"></i>My Profile
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-3 text-center mb-4">
                            <div class="profile-avatar position-relative mx-auto mb-3">
                                <img src="https://via.placeholder.com/120" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                                <label class="avatar-upload position-absolute bottom-0 end-0 bg-primary rounded-circle p-2 cursor-pointer">
                                    <i class="fas fa-camera fs-6 text-white"></i>
                                    <input type="file" class="d-none">
                                </label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Full Name</label>
                                    <input type="text" class="form-control" value="Admin Administrator">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" class="form-control" value="admin@carehospital.com">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Phone</label>
                                    <input type="tel" class="form-control" value="+91 98765 43210">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Role</label>
                                    <input type="text" class="form-control bg-light" value="Super Admin" readonly>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-semibold">Bio</label>
                                    <textarea class="form-control" rows="3">System administrator managing Care Hospital platform...</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Profile
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Security Modal --}}
<div class="modal fade" id="securityModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-shield-alt me-2"></i>Account Security
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4 p-3 bg-light rounded">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Password Strength</span>
                        <span class="badge bg-success">Strong</span>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: 85%"></div>
                    </div>
                </div>
                <form>
                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="twofa">
                        <label class="form-check-label" for="twofa">
                            Enable Two-Factor Authentication
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success">
                    <i class="fas fa-lock me-2"></i>Update Security
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Notification Modal --}}
<div class="modal fade" id="notificationModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title">
                    <i class="fas fa-bell me-2"></i>Notification Preferences
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="emailNotify" checked>
                    <label class="form-check-label" for="emailNotify">Email Notifications</label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="smsNotify">
                    <label class="form-check-label" for="smsNotify">SMS Alerts</label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="appNotify" checked>
                    <label class="form-check-label" for="appNotify">Browser Notifications</label>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning text-dark fw-semibold">Save Preferences</button>
            </div>
        </div>
    </div>
</div>

{{-- Other Modals (Shortened) --}}
<div class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Site Settings</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Site Title</label>
                        <input type="text" class="form-control" value="Care Hospital">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Site URL</label>
                        <input type="url" class="form-control" value="https://carehospital.com">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Email, Logs, Backup Modals (same as before but shortened) --}}
<div class="modal fade" id="emailModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title">Email Status</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-4">
                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                <div class="fw-bold fs-5 mb-2">SMTP Active</div>
                <small class="text-muted">Gmail • Port: 587</small>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="logsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(45deg, #6f42c1, #8b5cf6); color: white;">
                <h5 class="modal-title">Recent Activity</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="activity-item mb-3 p-3 border rounded">
                    <div class="d-flex justify-content-between">
                        <span><i class="fas fa-user-check text-success me-2"></i>Doctor approved</span>
                        <small class="text-muted">2 min ago</small>
                    </div>
                </div>
                <div class="activity-item mb-3 p-3 border rounded">
                    <div class="d-flex justify-content-between">
                        <span><i class="fas fa-user-plus text-info me-2"></i>New patient</span>
                        <small class="text-muted">5 min ago</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="backupModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Backup Status</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-3">
                    <i class="fas fa-check-circle fa-2x text-success"></i>
                    <span class="ms-2 fw-bold">Up to date</span>
                </div>
                <small class="text-muted d-block mb-3">Last: 2024-01-15 10:30 | 2.5 GB</small>
                <button class="btn btn-outline-dark w-100">Create New Backup</button>
            </div>
        </div>
    </div>
</div>

<style>
.widget-card {
    border: 1px solid #e9ecef;
    border-radius: 16px;
    transition: all 0.3s ease;
    background: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.widget-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.12);
    border-color: #dee2e6;
}

.logout-widget:hover {
    border-color: #f8d7da !important;
    background: #f8d7da !important;
}

.logout-icon:hover {
    background: rgba(220, 53, 69, 0.15) !important;
}

.profile-avatar {
    width: 120px;
    height: 120px;
}

.profile-widget {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 1rem;
    border-radius: 12px;
    border: 1px solid #dee2e6;
}

.profile-widget .avatar {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.activity-item:hover {
    background: #f8f9ff;
}

.cursor-pointer {
    cursor: pointer;
}

@media (max-width: 768px) {
    .widget-icon {
        width: 60px !important;
        height: 60px !important;
    }
    .profile-widget {
        margin-top: 1rem;
    }
}
</style>

@endsection