<?php view('partials/header') ?>


<div id="viewport">

    <?php view('partials/sidebar') ?>

    <!-- Content -->
    <div id="content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-md-12">

                    <div class="create_button my-4">
                        <a href="<?php url('/create') ?>" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50" style="font-size: 18px; color:white; font-weight:bold">+</span>
                            <span class="text">Create Report</span>
                        </a>
                    </div>



                    <div class="task_list">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 row">

                                <div class="col-md-12 mb-3">
                                    <h6 class="font-weight-bold" style="font-size: 22px; margin-top:15px;">REPORT LIST</h6>
                                </div>

                                <div class="col-md-12">
                                    <form action="<?php url('/') ?>" method="get">
                                        <div class="row">
                                            <!-- sort by user id-->
                                            <div class="col-md-3">
                                                <span>Sort by user ID</span>
                                                <div class="user_id">
                                                    <input type="text" class="form-control" name="user_id" value="<?= isset($_GET['user_id']) ? htmlspecialchars($_GET['user_id']) : '' ?>">
                                                </div>
                                            </div>

                                            <!-- sort by start date -->
                                            <div class=" col-md-3">
                                                <span>Start date</span>
                                                <div class="start_date">
                                                    <input type="date" class="form-control" name="start_date"
                                                        value="<?= isset($_GET['start_date']) ? htmlspecialchars($_GET['start_date']) : '' ?>">
                                                </div>
                                            </div>
                                            <!-- sort by end date -->
                                            <div class="col-md-3">
                                                <span>End date</span>
                                                <div class="end_date">
                                                    <input type="date" class="form-control" name="end_date"
                                                        value="<?= isset($_GET['end_date']) ? htmlspecialchars($_GET['end_date']) : '' ?>" >
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <span>Search here</span>
                                                <div class="search_btn">
                                                    <button type="submit" class="btn btn-sm btn-primary">Search</button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>

                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="dataTables_wrapper dt-bootstrap4">
                                        <table class="table table-bordered table-striped w-100">
                                            <thead>
                                                <tr>
                                                    <th>Serial no.</th>
                                                    <th>Buyer name</th>
                                                    <th>Buyer Ip</th>
                                                    <th>Items</th>
                                                    <th>Note</th>
                                                    <th>User Id (entry by)</th>
                                                    <th>Entry Date</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if (count($submissions) > 0): ?>
                                                    <?php $serial = 1; ?>
                                                    <?php foreach ($submissions as $submission): ?>

                                                        <?php $items = unserialize($submission['items']); ?>

                                                        <tr>
                                                            <td><?= $serial ?></td>
                                                            <td><?= htmlspecialchars($submission['buyer']); ?></td>
                                                            <td><?= htmlspecialchars($submission['buyer_ip']); ?></td>
                                                            <td>
                                                                <?php
                                                                if (is_array($items)) {
                                                                    foreach ($items as $item) {
                                                                        echo "- " . htmlspecialchars($item) . "<br>";
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?= htmlspecialchars($submission['note']); ?></td>
                                                            <td><?= htmlspecialchars($submission['entry_by']); ?></td>
                                                            <td><?= htmlspecialchars($submission['entry_at']); ?></td>
                                                        </tr>
                                                    <?php $serial++;
                                                    endforeach; ?>

                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="50">
                                                            <span style="color: red;">No submissions data found.</span>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<?php view('partials/footer') ?>