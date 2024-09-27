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
                            <a href="<?= base_url() ?>student/insert"
                                class="btn btn-primary btn-round ms-auto">
                                <i class="fa fa-plus"></i>
                                Add Data
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
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>nrp</th>
                                        <th>program</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($students as $student) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $student->student_name; ?></td>
                                            <td><?= $student->student_address; ?></td>
                                            <td><?= $student->nrp;?></td>
                                            <td><?= $student->program_name; ?></td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="<?= base_url() ?>student/edit/<?= $student->id_student; ?>" class="btn btn-link btn-primary"><i class="fa fa-edit"></i></a>
                                                    <a href="#" class="btn btn-link btn-danger" onclick="deleteConfirm(<?= $student->id_student; ?>, '<?= base_url() ?>student/delete/')"><i class="fa fa-trash"></i></a>
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