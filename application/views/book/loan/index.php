<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3"><?= $title; ?></h3>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Add Row</h4>
                            <a href="<?= base_url() ?>loan/add_form"
                                class="btn btn-primary btn-round ms-auto">
                                <i class="fa fa-plus"></i>
                                Add
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                id="add-row"
                                class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Borrowed By</th>
                                        <th>Student ID</th>
                                        <th>Book ID</th>
                                        <th>Loan Date</th>
                                        <th>Code</th>
                                        <th>Expired Date</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($loans as $loan) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $loan->borrower_name; ?></td>
                                            <td><?= $loan->student_id; ?></td>
                                            <td><?= $loan->book_id; ?></td>
                                            <td><?= $loan->loan_date; ?></td>
                                            <td><?= $loan->code; ?></td>
                                            <td><?= $loan->expired_date; ?></td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="#" class="btn btn-link btn-danger" onclick="deleteConfirm(<?= $loan->id_loan; ?>, '<?= base_url() ?>loan/delete/')"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>