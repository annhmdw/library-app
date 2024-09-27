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
                            <a href="<?= base_url() ?>book/insert"
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
                                        <th>Name</th>
                                        <th>category</th>
                                        <th>publisher</th>
                                        <th>cover</th>
                                        <th>status</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($books as $book) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $book->book_name; ?></td>
                                            <td><?= $book->category_name; ?></td>
                                            <td><?= $book->publisher; ?></td>
                                            <td>
                                                <img src="<?= $book->cover; ?>" alt="<?= snake_case($book->book_name); ?>" style="height : 150px;">
                                            </td>
                                            <td>
                                                <?php if ($book->book_status == 1) : ?>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input status-book" type="checkbox" role="switch" data-status="<?= $book->book_status ?>" data-id="<?= $book->id_book ?>" checked>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input status-book" type="checkbox" role="switch" data-status="<?= $book->book_status ?>" data-id="<?= $book->id_book ?>">
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="<?= base_url() ?>book/edit/<?= $book->id_book; ?>" class="btn btn-link btn-primary btn=lg"><i class="fa fa-edit"></i></a>
                                                    <a href="#" class="btn btn-link btn-danger" onclick="deleteConfirm(<?= $book->id_book; ?>, '<?= base_url() ?>book/delete/')"><i class="fa fa-trash"></i></a>
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