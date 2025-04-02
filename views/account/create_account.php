<style>
/* Ensure the content wrapper has proper spacing */
.content-wrapper {
    padding: 1.5rem;
}

/* Style the card body */
.card-body {
    padding: 2rem;
    
}

/* Form styling */
form {
    max-width: 100%; /* Optional: limits form width */
    margin: 0 auto; /* Centers the form */
}

/* Form group styling */
form div {
    margin-bottom: 1.25rem; /* Spacing between form groups */
}

.row-form{
    display: flex;
    gap: 20px;
}
/* Label styling */
form label {
    display: block;
    font-weight: 500;
    margin-bottom: 0.5rem;
    color: #566a7f; /* Matches Bootstrap muted text */
}

/* Input styling */
form input[type="text"],
form input[type="email"],
form input[type="password"],
form input[type="file"],
form select {
    display: block;
    width: 520px;
    padding: 0.5rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    border: 1px solid #d9dee3;
    border-radius: 0.375rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

form input[type="file"]{
    width: 100%;
    height: 100px;
}

/* Input focus state */
form input[type="text"]:focus,
form input[type="email"]:focus,
form input[type="password"]:focus,
form select:focus {
    outline: 0;
    border-color: #696cff; /* Primary color from Bootstrap */
    box-shadow: 0 0 0 0.2rem rgba(105, 108, 255, 0.25);
}

/* Error message styling */
.error {
    display: block;
    color: #ff3e1d; /* Bootstrap danger color */
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

/* Button styling */
form button[type="submit"] {
    display: inline-block;
    padding: 0.5rem 1.5rem;
    font-size: 1rem;
    font-weight: 500;
    color: #fff;
    background-color: #696cff; /* Primary color */
    border: none;
    border-radius: 0.375rem;
    cursor: pointer;
    transition: background-color 0.15s ease-in-out;
}

form button[type="submit"]:hover {
    background-color: #595cd9; /* Darker shade on hover */
}

/* Match the upload button styling */
.button-wrapper .btn {
    padding: 0.5rem 1rem;
    font-size: 0.9375rem;
}

/* Ensure the image preview stays aligned */
#uploadedAvatar {
    object-fit: cover; /* Keeps image aspect ratio */
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .card-body {
        padding: 1rem;
    }
    
    .d-flex.align-items-start {
        flex-direction: column;
        gap: 1rem;
    }
    
    .button-wrapper {
        width: 100%;
    }
}
</style>
       
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="../assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>
                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form method="POST" action="/user_account" enctype="multipart/form-data">
                           <div class="row-form">
                                <div>
                                    <label>Username</label>
                                    <input type="text" name="username" value="<?= $data['form_data']['username'] ?? '' ?>">
                                    <?php if (isset($data['errors']['username'])): ?>
                                        <span class="error"><?= $data['errors']['username'] ?></span>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <label>Email</label>
                                    <input type="email" name="email" value="<?= $data['form_data']['email'] ?? '' ?>">
                                    <?php if (isset($data['errors']['email'])): ?>
                                        <span class="error"><?= $data['errors']['email'] ?></span>
                                    <?php endif; ?>
                                </div>
                           </div>
                            <div class="row-form">
                                <div>
                                    <label>Password</label>
                                    <input type="password" name="password_hash"> <!-- Fixed type and name -->
                                    <?php if (isset($data['errors']['password'])): ?>
                                        <span class="error"><?= $data['errors']['password'] ?></span>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <label>Role</label>
                                    <select name="role">
                                        <option value="admin" <?= ($data['form_data']['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                                        <option value="cashier" <?= ($data['form_data']['role'] ?? '') === 'cashier' ? 'selected' : '' ?>>Cashier</option>
                                    </select>
                                    <?php if (isset($data['errors']['role'])): ?>
                                        <span class="error"><?= $data['errors']['role'] ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <button type="submit">Create Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                  
  