<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update | Account</title>

    @include('admin.layouts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/dssc_logo_official.png') }}" type="image/png">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 70px;
        }

        .profile-container {
            margin-top: 100px;
            max-width: 600px;
            margin: 1rem auto;
            padding: 1.3rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        h1 {
            color: #1a1a1a;
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 0.7rem;
        }

        .form-group label {
            font-size: 0.8rem;
            margin-bottom: 0.3rem;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="file"] {
            width: 100%;
            padding: 0.5rem;
            font-size: 0.85rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }

        .form-group i {
            font-size: 0.7rem;
            margin-right: 0.3rem;
        }

        .avatar-preview {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #e2e8f0;
        }

        .avatar-section {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .button-group {
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            margin-top: 1.5rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .btn i {
            font-size: 0.8rem;
        }

        .btn-primary {
            background-color: #4299e1;
            color: white;
        }

        .btn-secondary {
            background-color: #f1f5f9;
            color: #475569;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 99;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            width: 90%;
            max-width: 400px;
            position: relative;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 1rem;
        }

        .modal-content h3 {
            margin-bottom: 1rem;
        }

        #previewImage {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 50%;
            margin-top: 0.5rem;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

<div class="profile-container">
    <!-- Confirmation Modal -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <h3><i class="fas fa-exclamation-circle"></i> Confirm Update</h3>
            <p>Are you sure you want to update your profile?</p>
            <div class="button-group">
                <button type="button" class="btn btn-secondary" onclick="hideConfirmModal()">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">
                    <i class="fas fa-check"></i> Yes, Update
                </button>
            </div>
        </div>
    </div>

    <!-- Profile Form -->
    <form action="{{ route('admin.updateProfile') }}" method="POST" enctype="multipart/form-data" id="profileForm">
        @csrf

        <div class="form-group">
            <label for="firstname"><i class="fas fa-user"></i> First Name</label>
            <input type="text" name="firstname" value="{{ $user->firstname }}" required>
        </div>

        <div class="form-group">
            <label for="lastname"><i class="fas fa-user-tag"></i> Last Name</label>
            <input type="text" name="lastname" value="{{ $user->lastname }}" required>
        </div>

        <div class="form-group">
            <label for="email"><i class="fas fa-envelope"></i> Email</label>
            <input type="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
            <label for="profile_picture"><i class="fas fa-camera"></i> Profile Picture</label>
            <div class="avatar-section">
                <input type="file" name="profile_picture" id="avatarInput" onchange="previewImage(event)">
                <img src="{{ $user->profile_picture ? asset('storage/'.$user->profile_picture) : 'https://via.placeholder.com/100' }}" class="avatar-preview" id="avatarPreview">
            </div>
        </div>

        <div class="button-group">
            <button type="button" class="btn btn-secondary" onclick="showPreview()">
                <i class="fas fa-eye"></i> Preview
            </button>
            <button type="button" class="btn btn-secondary" onclick="cancelEdit()">
                <i class="fas fa-times"></i> Cancel
            </button>
            <button type="button" class="btn btn-primary" onclick="showConfirmModal()">
                <i class="fas fa-save"></i> Update
            </button>
        </div>
    </form>

    <!-- Preview Modal -->
    <div id="previewModal" class="modal">
        <div class="modal-content">
            <h3>Profile Preview</h3>
            <p id="previewName"></p>
            <p id="previewEmail"></p>
            <img id="previewImage" src="{{ $user->profile_picture ? asset('storage/'.$user->profile_picture) : 'https://via.placeholder.com/100' }}">
            <div class="button-group">
                <button class="btn btn-primary" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showConfirmModal() {
        document.getElementById('confirmModal').style.display = 'block';
    }

    function hideConfirmModal() {
        document.getElementById('confirmModal').style.display = 'none';
    }

    function submitForm() {
        document.getElementById('profileForm').submit();
    }

    function showPreview() {
        const name = document.querySelector('input[name="firstname"]').value;
        const last = document.querySelector('input[name="lastname"]').value;
        const email = document.querySelector('input[name="email"]').value;
        document.getElementById('previewName').innerHTML = `<strong>Name:</strong> ${name} ${last}`;
        document.getElementById('previewEmail').innerHTML = `<strong>Email:</strong> ${email}`;

        const fileInput = document.getElementById('avatarInput');
        const previewImage = document.getElementById('previewImage');

        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
            };
            reader.readAsDataURL(fileInput.files[0]);
        }

        document.getElementById('previewModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('previewModal').style.display = 'none';
    }

    function cancelEdit() {
        window.location.href = "{{ route('admin.profileEdit') }}";
    }

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById('avatarPreview').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    window.onclick = function (event) {
        const previewModal = document.getElementById('previewModal');
        const confirmModal = document.getElementById('confirmModal');
        if (event.target === previewModal) {
            previewModal.style.display = 'none';
        }
        if (event.target === confirmModal) {
            confirmModal.style.display = 'none';
        }
    };
</script>

</body>
</html>
