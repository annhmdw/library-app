<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Forms</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><?= $title ?></div>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="text" name="id_student" value="<?= $student->id_student ?>" hidden>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="student_name">Name</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="student_name"
                                                id="student_name"
                                                placeholder="Insert student name"
                                                value="<?= $student->student_name ?>" />
                                            <small id="student_name" class="form-text text-danger"><?= form_error('student_name') ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="student_address">Address</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="student_address"
                                                id="student_address"
                                                placeholder="Insert student address"
                                                value="<?= $student->student_address ?>" />
                                            <small id="student_address" class="form-text text-danger"><?= form_error('student_address') ?></small>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nrp">NRP</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="nrp"
                                                id="nrp"
                                                placeholder="Insert nrp"
                                                value="<?= $student->nrp ?>" />
                                            <small id="nrp" class="form-text text-danger"><?= form_error('nrp') ?></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="program">Program</label>
                                            <select
                                                class="form-select form-control" name="program_id"
                                                id="program">
                                                <?php foreach ($programs as $program) : ?>
                                                    <?php if ($student->program_id == $program->id_program) : ?>
                                                        <option value="<?= $program->id_program ?>" selected><?= $program->program_name ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $program->id_program ?>"><?= $program->program_name ?></option>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <a href="<?= base_url() ?>student" class="btn btn-danger">Batal</a>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>