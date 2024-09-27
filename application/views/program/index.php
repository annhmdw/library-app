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
                            <h4 class="card-title">Add Program</h4>
                            <button type="button" class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addProgramModal">
                                <i class="fa fa-plus"></i>
                                Add
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($programs as $program) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $program->program_name; ?></td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input status-program" type="checkbox" role="switch"
                                                        data-status="<?= $program->program_status ?>"
                                                        data-id="<?= $program->id_program ?>"
                                                        <?= $program->program_status == 1 ? 'checked' : '' ?>>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" class="btn btn-link btn-primary btn-lg edit-button" data-bs-toggle="modal" data-bs-target="#editProgramModal" data-id="<?= $program->id_program; ?>" data-name="<?= $program->program_name; ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <a href="#" class="btn btn-link btn-danger" onclick="deleteConfirm(<?= $program->id_program; ?>, '<?= base_url() ?>program/delete/')"><i class="fa fa-trash"></i></a>
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

<div class="modal fade" id="addProgramModal" tabindex="-1" aria-labelledby="addProgramModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProgramModalLabel">Add New Program</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addProgramForm" action="<?= base_url('program/insert') ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="program_name" class="form-label">Program Name</label>
                        <input type="text" class="form-control" id="program_name" name="program_name" required>
                        <small id="program_name" class="form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editProgramModal" tabindex="-1" aria-labelledby="editProgramModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProgramModalLabel">Edit Program</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('program/edit') ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id_program">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Program Name</label>
                        <input type="text" class="form-control" id="edit_name" name="program_name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>