<?php
include 'header.php';
?>
<div class="admin-block mb-3">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-sm-6 py-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="color-deco" title="Number of Users">Users</h5>
                        <h3 class="mt-3 mb-3">36,254</h3>
                        <p class="mb-0">
                            <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 5.27%</span>
                            <span class="text-nowrap">Since last month</span>  
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 py-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="color-deco" title="Number of Blogs">Customers</h5>
                        <h3 class="mt-3 mb-3">36,254</h3>
                        <p class="mb-0">
                            <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 5.27%</span>
                            <span class="text-nowrap">Since last month</span>  
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  
<div class="container">
  <h3>Hello, <?=ucfirst($_SESSION['user_data']['username']);?></h3>
  <p>Welcome to Tesla G-EV electric toys to electric cars.</p>
</div>

<?php
include 'footer.php';
?>