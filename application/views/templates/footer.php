<!-- JQuery -->
<script src="<?= base_url() ?>assets/assets/js/core/jquery-3.7.1.min.js"></script>

<!-- Popper JS -->
<script src="<?= base_url() ?>assets/assets/js/core/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="<?= base_url() ?>assets/assets/js/core/bootstrap.min.js"></script>

<!-- Filepond JS -->
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

<!-- Filepond JQuery -->
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

<!-- Filepond File Validate Type -->
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>

<!-- Filepond File Validate Size -->
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>

<!-- Filepond Image Preview -->
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>

<!-- Chart JS -->
<script src="<?= base_url() ?>assets/assets/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="<?= base_url() ?>assets/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="<?= base_url() ?>assets/assets/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="<?= base_url() ?>assets/assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="<?= base_url() ?>assets/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="<?= base_url() ?>assets/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
<script src="<?= base_url() ?>assets/assets/js/plugin/jsvectormap/world.js"></script>

<!-- Google Maps Plugin -->
<script src="<?= base_url() ?>assets/assets/js/plugin/gmaps/gmaps.js"></script>

<!-- Sweet Alert -->
<script src="<?= base_url() ?>assets/assets/js/plugin/sweetalert/sweetalert.min.js"></script>


<script>
    /* DataTable Configuration */
    $(document).ready(function() {
        $("#basic-datatables").DataTable({});

        $("#multi-filter-select").DataTable({
            pageLength: 5,
            initComplete: function() {
                this.api()
                    .columns()
                    .every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-select"><option value=""></option></select>'
                            )
                            .appendTo($(column.footer()).empty())
                            .on("change", function() {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                column
                                    .search(val ? "^" + val + "$" : "", true, false)
                                    .draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function(d, j) {
                                select.append(
                                    '<option value="' + d + '">' + d + "</option>"
                                );
                            });
                    });
            },
        });

        // Add Row
        $("#add-row").DataTable({
            pageLength: 5,
        });

        var action =
            '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $("#addRowButton").click(function() {
            $("#add-row")
                .dataTable()
                .fnAddData([
                    $("#addName").val(),
                    $("#addPosition").val(),
                    $("#addOffice").val(),
                    action,
                ]);
            $("#addRowModal").modal("hide");
        });

    });


    /* Delete confirmation with SweetAlert 2 */
    function deleteConfirm(id, url) {
        swal({
            title: "Are you sure you want to delete this data?",
            text: "You can\'t recover data that has been deleted! ",
            type: "warning",
            buttons: {
                cancel: {
                    visible: true,
                    text: "Cancel",
                    className: "btn btn-success",
                },
                confirm: {
                    text: "Yes, delete it!",
                    className: "btn btn-danger",
                },
            },
        }).then((willDelete) => {
            if (willDelete) {
                window.location.href = url + id;
            }
        });
    }


    /* Trigger SweetAlert 2 with flashdata */
    <?php if ($this->session->flashdata('msg')) : ?>
        <?php $msg = $this->session->flashdata('msg'); ?>
        swal({
            title: '<?= $msg['status'] ?>!',
            text: '<?= $msg['msg'] ?>',
            icon: '<?= $msg['type'] ?>',
            button: 'OK'
        });
    <?php endif; ?>


    /* File upload configuration with filepond */

    FilePond.registerPlugin(FilePondPluginFileValidateSize, FilePondPluginFileValidateType, FilePondPluginImagePreview);

    $('.filepond').filepond({
        allowMultiple: false,
        acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg', 'image/webp'],
        allowImagePreview: true,
        imagePreviewHeight: 150,
        maxFileSize: '2MB',
        allowRevert: true,
        server: {
            process: {
                url: '<?= base_url("book/upload") ?>',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?= $this->security->get_csrf_hash() ?>'
                },
                onload: (response) => {
                    try {
                        const data = JSON.parse(response);
                        console.log('Upload response:', data);
                        if (data) {
                            $('input[name="book_cover"]').val(data);
                            console.log('Form data:', $('input[name="book_cover"]').val());
                            return data;
                        } else if (data.error) {
                            console.error('Upload error:', data.error);
                        }
                    } catch (e) {
                        console.error('JSON parse error:', e);
                    }
                    return '';
                }
            }
        }
    });


    /* Set the book status */
    $('.status-book').on('change', function() {
        var status = $(this).prop('checked') ? 1 : 0;
        var id = $(this).data('id');

        $.ajax({
            url: '<?= base_url() ?>/book/update_status/' + id,
            type: 'POST',
            data: {
                id_book: id,
                book_status: status
            },
            success: function(response) {
                const responseStatus = JSON.parse(response);
                if (responseStatus) {
                    let text = status == 1 ? 'activated' : 'deactivated';
                    swal({
                        title: 'Success!',
                        text: 'Book data has been successfully ' + text + '!',
                        icon: 'success',
                        button: 'OK'
                    })
                } else {
                    swal({
                        title: 'Failed!',
                        text: 'Book data can\'t deactivated because it is still being borrowed!',
                        icon: 'error',
                        button: {
                            confirm: {
                                text: 'OK',
                                value: true,
                                visible: true,
                                className: 'btn btn-success',
                                closeModal: true
                            }
                        }
                    }).then((value) => {
                        if (value) {
                            location.reload();
                        }
                    })
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    })


    /* Set the program status */
    $('.status-program').on('change', function() {
        var status = $(this).prop('checked') ? 1 : 0;
        var id = $(this).data('id');

        $.ajax({
            url: '<?= base_url() ?>/program/update_status/' + id,
            type: 'POST',
            data: {
                id_program: id,
                program_status: status
            },
            success: function(response) {
                const responseStatus = JSON.parse(response);
                if (responseStatus) {
                    let text = status == 1 ? 'activated' : 'deactivated';
                    swal({
                        title: 'Success!',
                        text: 'Program data has been successfully ' + text + '!',
                        icon: 'success',
                        button: 'OK'
                    })
                } else {
                    swal({
                        title: 'Failed!',
                        text: 'Program data can\'t deactivated because it is still being used!',
                        icon: 'error',
                        button: {
                            confirm: {
                                text: 'OK',
                                value: true,
                                visible: true,
                                className: 'btn btn-success',
                                closeModal: true
                            }
                        }
                    }).then((value) => {
                        if (value) {
                            location.reload();
                        }
                    })
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    })

    /* Set the category status */
    $('.status-category').on('change', function() {
        var status = $(this).prop('checked') ? 1 : 0;
        var id = $(this).data('id');

        console.log(status), id;

        $.ajax({
            url: '<?= base_url() ?>/category/update_status/' + id,
            type: 'POST',
            data: {
                id_category: id,
                category_status: status
            },
            success: function(response) {
                const responseStatus = JSON.parse(response);
                if (responseStatus) {
                    let text = status == 1 ? 'activated' : 'deactivated';
                    swal({
                        title: 'Success!',
                        text: 'Category data has been successfully ' + text + '!',
                        icon: 'success',
                        button: 'OK'
                    })
                } else {
                    swal({
                        title: 'Failed!',
                        text: 'Category data can\'t deactivated because it is still being used!',
                        icon: 'error',
                        button: {
                            confirm: {
                                text: 'OK',
                                value: true,
                                visible: true,
                                className: 'btn btn-success',
                                closeModal: true
                            }
                        }
                    }).then((value) => {
                        if (value) {
                            location.reload();
                        }
                    })
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });


    /* Insert Id and Name value into form input with data attribute */
    $(document).ready(function() {
        $(document).on('click', '.edit-button', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');

            $('#edit_id').val(id);
            $('#edit_name').val(name);
        });
    });

    /* Reload page */
    function reloadPage() {
        location.reload();
    }
</script>

</body>

</html>