
<style>
    .authentication-wrapper {
        height: 90vh; /* Full height for centering */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        width: 500px; /* Set a fixed width for the card */
        padding: 2rem; /* Add padding for the card */
        border-radius: 10px; /* Rounded corners */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Soft shadow */
    }

    .btn-primary {
        background-color: #696cff; /* Primary button color */
        border: none; /* No border */
    }

    .btn-primary:hover {
        background-color: #5850e0; /* Darker shade on hover */
    }

    .form-control {
        border-radius: 5px; /* Rounded input fields */
    }

    .form-check-input {
        border-radius: 5px; /* Rounded checkbox */
    }

    .app-brand-text {
        font-size: 1.5rem; /* Adjust brand text size */
        margin-bottom: 1rem; /* Space below brand text */
    }
</style>

<!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <span class="app-brand-text demo text-body fw-bolder">Heng Heng</span>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Welcome to Sneat! 👋</h4>
              <p class="mb-4">Please sign-in to your account and start the adventure</p>

              <form id="formAuthentication" class="mb-3" action="index.html" method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label">Email or Username</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email-username"
                    placeholder="Enter your email or username"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="auth-forgot-password-basic.html">
                      <small>Forgot Password?</small>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                </div>
              </form>

              <p class="text-center">
                <span>New on our platform?</span>
                <a href="auth-register-basic.html">
                  <span>Create an account</span>
                </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->