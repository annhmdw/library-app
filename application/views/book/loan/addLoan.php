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
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">Borrowed By</label>
                                            <select
                                                class="form-select form-control" name="student_id"
                                                id="student_id">
                                                <?php foreach ($students as $student) : ?>
                                                    <option value="<?= $student->id_student ?>"><?= $student->student_name ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="book_id">Book</label>
                                            <select
                                                class="form-select form-control" name="book_id"
                                                id="book_id">
                                                <?php foreach ($books as $book) : ?>
                                                    <option value="<?= $book->id_book ?>"><?= $book->book_name ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="<?= base_url() ?>loan" class="btn btn-danger">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>