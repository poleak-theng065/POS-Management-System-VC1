
        <!-- / Menu -->
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class=" row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                          src="../assets/img/avatars/1.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="upload"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpeg"
                            />
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
                      <form id="formAccountSettings" method="POST" onsubmit="return false">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input
                              class="form-control"
                              type="text"
                              id="firstName"
                              name="firstName"
                              autofocus
                              />
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="email" class="form-label">E-mail</label>
                              <input
                                class="form-control"
                                type="text"
                                id="email"
                                name="email"
                                placeholder="john.doe@example.com"
                              />
                            </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Password</label>
                            <input class="form-control" type="text" name="password" id="password"/>
                          </div>
                          <div class="mb-3 col-md-6">
                              <label class="form-label" for="role">Role</label>
                              <select id="role" class="select2 form-select">
                                  <option value="">Select Role</option>
                                  <option value="Admin">Admin</option>
                                  <option value="Employee">Employee</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6 create_date">
                              <label for="date" class="form-label">Create-Date</label>
                              <input class="form-control" type="text" name="date" id="date" />
                            </div>
                            <div class="mt-3 save">
                                <button type="submit" class="btn btn-primary me-2 ">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                  
  