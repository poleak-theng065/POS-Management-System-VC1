<?php session_start(); ?>
<?php if (isset($_SESSION['users']) && $_SESSION['users'] === true): ?>
  <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-lg-8 mb-4 order-0">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Congratulations John! 🎉</h5>
                  <p class="mb-4">
                    You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                    your profile.
                  </p>

                  <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                </div>
              </div>
              <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img
                    src="../assets/img/illustrations/man-with-laptop-light.png"
                    height="140"
                    alt="View Badge User"
                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Total Sold, Total Profit, and Total Cost Price -->
        <?php include_once 'dashbord_component/_totalSold.php'; ?>

        <!-- Total Revenue -->
        <?php include_once 'dashbord_component/_totalRevenue.php'; ?>

        <!-- Total Profit Report -->
        <?php include_once 'dashbord_component/_totalProfitReport.php'; ?>

      </div>
      <div class="row">
        <!-- Order Statistics -->
        <?php include_once 'dashbord_component/_orderStatistics.php'; ?>
        <!--/ Order Statistics -->

        <!-- Expense Overview -->
        <?php include_once 'dashbord_component/_expenseOverview.php'; ?>
        <!--/ Expense Overview -->

        <!-- Transactions -->
        <?php include_once 'dashbord_component/_transactions.php'; ?>
        <!--/ Transactions -->
      </div>
    </div>
    <!-- / Content -->

  <?php else: ?>
    <?php $this->redirect('/login'); ?>
  <?php endif; ?>