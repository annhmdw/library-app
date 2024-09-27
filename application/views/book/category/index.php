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
                            <button type="button" class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                <i class="fa fa-plus"></i>
                                Add
                            </button>
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
                                        <th>status</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($categories as $category) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $category->category_name; ?></td>
                                            <td>
                                                <?php if ($category->category_status == 1) : ?>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input status-category" type="checkbox" role="switch" data-status="<?= $category->category_status ?>" data-id="<?= $category->id_category ?>" checked>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input status-category" type="checkbox" role="switch" data-status="<?= $category->category_status ?>" data-id="<?= $category->id_category ?>">
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" class="btn btn-link btn-primary btn-lg edit-button" id="data-<?= $category->id_category ?>" data-bs-toggle="modal" data-bs-target="#edit_categoryModal" data-id="<?= $category->id_category; ?>" data-name="<?= $category->category_name; ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <a href="#" class="btn btn-link btn-danger" onclick="deleteConfirm(<?= $category->id_category; ?>, '<?= base_url() ?>category/delete/')"><i class="fa fa-trash"></i></a>
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

<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addCategoryForm" action="<?= base_url('category/insert') ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" required>
                        <small id="category_name" class="form-text text-danger"></small>
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

<div class="modal fade" id="edit_categoryModal" tabindex="-1" aria-labelledby="edit_categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_categoryModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('category/edit') ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id_category" value="">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="edit_name" name="category_name" value="" required>
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