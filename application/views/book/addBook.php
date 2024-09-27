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
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger">
                                <?= $error ?>
                            </div>
                        <?php endif; ?>
                        <?= form_open_multipart(base_url() . 'book/insert') ?>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="book_name"
                                            id="name"
                                            placeholder="Insert name" />
                                        <small id="name" class="form-text text-danger"><?= form_error('book_name') ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select
                                            class="form-select form-control" name="category_id"
                                            id="category_id">
                                            <?php foreach ($categories as $category) : ?>
                                                <option value="<?= $category->id_category ?>"><?= $category->category_name ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="publisher">Publisher</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="publisher"
                                            id="publisher"
                                            placeholder="Insert publisher" />
                                    </div>
                                    <small id="name" class="form-text text-danger"><?= form_error('publisher') ?></small>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="userfile">Cover</label>
                                        <input type="file" class="filepond" name="book_cover" accept="image/webp, image/jpeg, image/png, image/jpg" />
                                        <?php if (isset($upload_error)): ?>
                                            <small class="text-danger"><?= $upload_error ?></small>
                                        <?php endif; ?>
                                        <small id="name" class="form-text text-danger"><?= form_error('book_cover') ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <a href="<?= base_url() ?>book" class="btn btn-danger">Batal</a>
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>