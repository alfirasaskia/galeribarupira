<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Settings - Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f5f5f5;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: #333;
        }

        /* Navbar styling - sama seperti galeri */
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 1rem 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 80px;
            border-bottom: 1px solid rgba(37, 99, 235, 0.1);
        }

        .navbar .container-fluid {
            max-width: 1400px;
            margin: 0 auto;
            padding-left: 3rem;
            padding-right: 3rem;
        }

        .navbar-brand {
            color: #1E40AF !important;
            font-weight: 700;
            font-size: 1.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
            margin-right: 4rem;
        }

        .navbar-brand span {
            color: #1E40AF !important;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .navbar-nav {
            margin-left: auto !important;
            margin-right: 0 !important;
        }

        .navbar-nav .nav-link {
            color: #374151 !important;
            font-weight: 400;
            padding: 0.5rem 0.75rem;
            margin: 0 0.25rem;
            border-radius: 6px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.95rem;
        }

        .navbar-nav .nav-link:hover {
            color: #1E40AF !important;
        }

        /* Main Content */
        .main-content {
            margin-top: 80px;
            min-height: calc(100vh - 80px);
        }

        /* Header with Gradient */
        .settings-header {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 25%, #2563eb 50%, #3b82f6 75%, #60a5fa 100%);
            height: 180px;
            position: relative;
            overflow: hidden;
        }

        .settings-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .settings-header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 10s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* Settings Container */
        .settings-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            position: relative;
            margin-top: -80px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        /* Profile Section */
        .profile-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 2rem 2.5rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .profile-info-left {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .profile-avatar-large {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12), 0 0 0 1px rgba(0, 0, 0, 0.05);
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: #1E40AF;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .profile-avatar-large:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(0, 0, 0, 0.05);
        }

        .profile-text {
            display: flex;
            flex-direction: column;
        }

        .profile-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 0.25rem;
        }

        .profile-email {
            font-size: 0.95rem;
            color: #666;
        }

        .view-profile-btn {
            padding: 0.5rem 1.5rem;
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            color: #374151;
            font-weight: 500;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.2s;
        }

        .view-profile-btn:hover {
            background: #f9fafb;
            border-color: #9ca3af;
            color: #1f2937;
        }

        /* Tabs Navigation */
        .settings-tabs {
            display: flex;
            gap: 0;
            padding: 0 2.5rem;
            border-bottom: 1px solid #e5e7eb;
            overflow-x: auto;
            background: #fafafa;
        }

        .settings-tabs::-webkit-scrollbar {
            height: 0;
        }

        .tab-link {
            padding: 1rem 1.5rem;
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            border-bottom: 3px solid transparent;
            white-space: nowrap;
            transition: all 0.3s ease;
            position: relative;
        }

        .tab-link:hover {
            color: #1a1a1a;
            background: rgba(102, 126, 234, 0.05);
        }

        .tab-link.active {
            color: #1a1a1a;
            border-bottom-color: #667eea;
            background: white;
            font-weight: 600;
        }

        .tab-link.active::before {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #1e40af 0%, #2563eb 50%, #3b82f6 100%);
            border-radius: 3px 3px 0 0;
        }

        /* Tab Content */
        .tab-content-area {
            padding: 2.5rem;
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
        }

        /* Form Styling */
        .form-section-header {
            margin-bottom: 1.5rem;
        }

        .form-section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .form-section-desc {
            font-size: 0.9rem;
            color: #666;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.95rem;
            transition: all 0.2s;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #1E40AF;
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .form-hint {
            font-size: 0.85rem;
            color: #6b7280;
            margin-top: 0.5rem;
        }

        /* Photo Upload Section */
        .photo-upload-section {
            display: flex;
            align-items: center;
            gap: 2rem;
            padding: 1.5rem;
            background: #f9fafb;
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        .current-photo-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #e5e7eb;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: #1E40AF;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .current-photo-preview:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }

        .photo-upload-info {
            flex: 1;
        }

        .photo-upload-title {
            font-size: 1rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .photo-upload-desc {
            font-size: 0.85rem;
            color: #6b7280;
            margin-bottom: 1rem;
        }

        .upload-btn-wrapper {
            position: relative;
            display: inline-block;
        }

        .upload-btn-wrapper input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .upload-btn {
            padding: 0.5rem 1.25rem;
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            color: #374151;
            font-weight: 500;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .upload-btn:hover {
            background: #f9fafb;
            border-color: #9ca3af;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.625rem 1.5rem;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            text-decoration: none;
            display: inline-block;
        }

        .btn-cancel {
            background: white;
            border: 1px solid #d1d5db;
            color: #374151;
        }

        .btn-cancel:hover {
            background: #f9fafb;
            border-color: #9ca3af;
            color: #1f2937;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 50%, #3b82f6 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 50%, #2563eb 100%);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
            transform: translateY(-1px);
        }

        /* Alert Styling */
        .alert {
            padding: 1rem 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border: none;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .alert-dismissible .btn-close {
            padding: 0.75rem;
        }

        /* Password Section Styling */
        .password-info-box {
            background: linear-gradient(135deg, rgba(30, 64, 175, 0.05) 0%, rgba(59, 130, 246, 0.05) 100%);
            border-left: 4px solid;
            border-image: linear-gradient(135deg, #1e40af 0%, #2563eb 50%, #3b82f6 100%) 1;
            padding: 1rem 1.25rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.08);
        }

        .password-info-box p {
            margin: 0;
            font-size: 0.9rem;
            color: #3b82f6;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar .container-fluid {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .settings-container {
                margin-top: -40px;
                border-radius: 0;
            }

            .profile-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
                padding: 1.5rem;
            }

            .profile-info-left {
                flex-direction: column;
                align-items: center;
                text-align: center;
                width: 100%;
            }

            .settings-tabs {
                padding: 0 1rem;
            }

            .tab-content-area {
                padding: 1.5rem;
            }

            .photo-upload-section {
                flex-direction: column;
                text-align: center;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    @include('gallery.partials.navbar')

    <div class="main-content">
        <!-- Gradient Header -->
        <div class="settings-header"></div>

        <!-- Settings Container -->
        <div class="settings-container">
            <!-- Profile Section -->
            <div class="profile-section">
                <div class="profile-info-left">
                    @if(isset($user->profile_photo) && !empty($user->profile_photo))
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="profile-avatar-large" id="headerAvatar">
                    @else
                        <div class="profile-avatar-large" id="headerAvatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="profile-text">
                        <h1 class="profile-title">Settings</h1>
                        <p class="profile-email">{{ $user->email }}</p>
                    </div>
                </div>
                <a href="{{ route('user.profile.show', $user->id) }}" class="view-profile-btn">View profile</a>
            </div>

            <!-- Tabs Navigation -->
            <div class="settings-tabs">
                <a href="#" class="tab-link active" data-tab="my-details">My details</a>
                <a href="#" class="tab-link" data-tab="profile">Profile</a>
                <a href="#" class="tab-link" data-tab="password">Password</a>
            </div>

            <!-- Tab Content -->
            <div class="tab-content-area">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ url('/user/profile/update') }}" method="POST" enctype="multipart/form-data" id="editProfileForm">
                    @csrf
                    @method('PUT')

                    <!-- My Details Tab -->
                    <div class="tab-pane active" id="my-details">
                        <div class="form-section-header">
                            <h2 class="form-section-title">My details</h2>
                            <p class="form-section-desc">Update your personal information</p>
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required placeholder="Enter your full name">
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="your.email@example.com">
                        </div>
                    </div>

                    <!-- Profile Tab -->
                    <div class="tab-pane" id="profile">
                        <div class="form-section-header">
                            <h2 class="form-section-title">Profile</h2>
                            <p class="form-section-desc">Manage your profile photo and bio</p>
                        </div>

                        <!-- Photo Upload -->
                        <div class="photo-upload-section">
                            @if(isset($user->profile_photo) && !empty($user->profile_photo))
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="current-photo-preview" id="photoPreview">
                            @else
                                <div class="current-photo-preview" id="photoPreview">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="photo-upload-info">
                                <h3 class="photo-upload-title">Profile Photo</h3>
                                <p class="photo-upload-desc">Upload a new profile picture. JPG, PNG or GIF. Max size 2MB.</p>
                                <div class="upload-btn-wrapper">
                                    <input type="file" name="profile_photo" id="profilePhotoInput" accept="image/*">
                                    <label for="profilePhotoInput" class="upload-btn">
                                        <i class="bi bi-upload me-2"></i>Upload Photo
                                    </label>
                                </div>
                                <div class="form-hint" id="photoPreviewText"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control" id="bio" name="bio" rows="4" placeholder="Tell us about yourself...">{{ old('bio', $user->bio ?? '') }}</textarea>
                            <p class="form-hint">Write a short bio to introduce yourself</p>
                        </div>
                    </div>

                    <!-- Password Tab -->
                    <div class="tab-pane" id="password">
                        <div class="form-section-header">
                            <h2 class="form-section-title">Password</h2>
                            <p class="form-section-desc">Please enter your current password to change your password.</p>
                        </div>

                        <div class="password-info-box">
                            <p><i class="bi bi-info-circle me-2"></i>Leave these fields blank if you don't want to change your password</p>
                        </div>

                        <div class="form-group">
                            <label for="current_password" class="form-label">Current password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="••••••••">
                        </div>

                        <div class="form-group">
                            <label for="new_password" class="form-label">New password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="••••••••">
                            <p class="form-hint">Your new password must be more than 8 characters.</p>
                        </div>

                        <div class="form-group">
                            <label for="new_password_confirmation" class="form-label">Confirm new password</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="••••••••">
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('user.profile.show', $user->id) }}" class="btn btn-cancel">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tab Switching
        document.querySelectorAll('.tab-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all tabs and panes
                document.querySelectorAll('.tab-link').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
                
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Show corresponding pane
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
                
                // Update button text based on active tab
                const submitBtn = document.querySelector('.btn-primary');
                if (tabId === 'password') {
                    submitBtn.textContent = 'Update password';
                } else {
                    submitBtn.textContent = 'Save changes';
                }
            });
        });

        // Preview photo before upload
        document.getElementById('profilePhotoInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Update main preview
                    const preview = document.getElementById('photoPreview');
                    if (preview.tagName === 'IMG') {
                        preview.src = e.target.result;
                    } else {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'current-photo-preview';
                        img.id = 'photoPreview';
                        preview.parentNode.replaceChild(img, preview);
                    }
                    
                    // Update header avatar
                    const headerAvatar = document.getElementById('headerAvatar');
                    if (headerAvatar.tagName === 'IMG') {
                        headerAvatar.src = e.target.result;
                    } else {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'profile-avatar-large';
                        img.id = 'headerAvatar';
                        headerAvatar.parentNode.replaceChild(img, headerAvatar);
                    }
                };
                reader.readAsDataURL(file);
                document.getElementById('photoPreviewText').textContent = 'Selected: ' + file.name;
            }
        });

        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>
</html>
