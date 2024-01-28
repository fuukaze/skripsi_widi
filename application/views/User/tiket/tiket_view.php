<div class="content-wrapper">
    <section class="conten-header">
        <div class="contianer-fluid">
            <div class="row mb-2">
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row mt-5">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Data Tiket </h3>
                        <a href="<?= base_url('tiket/add_tiket') ?>" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#form_tiket"> Tambah Data </a>
                    </div>
                    <div class="card-body">
                        <?= $this->session->flashdata('message'); ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Tiket</th>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($tiket as $row) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->no_tiket ?></td>
                                        <td><?= $row->judul_tiket ?></td>
                                        <td>
                                            <?php if ($row->status_tiket == '0') {
                                                echo '<span class= "badge badge-danger">waiting...</span>';
                                            } else if ($row->status_tiket == '1') {
                                                echo '<span class= "badge badge-info">process...</span>';
                                            } else if ($row->status_tiket == '2') {
                                                echo '<span class= "badge badge-warning">Replied...</span>';
                                            } else {
                                                echo '<span class= "badge badge-success">complete</span>';
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <a href="<?= base_url('tiket/detail_tiket/' . $row->no_tiket) ?>" class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye"> </i>
                                            </a>
                                            <a onclick="return confirm(' Yakin akan menghapus ?');" href="<?= base_url('tiket/delete_tiket/' . $row->id_tiket) ?>" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"> </i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="form_tiket">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Tambah Proposal</h5>
                <button class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('tiket/save_tiket') ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Judul Proposal</label>
                        <input type="hidden" name="no_tiket" value="<?= $no_tiket ?>" class="form-control">
                        <input type="text" name="judul_tiket" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Penjelasan Singkat</label>
                        <textarea name="deskripsi" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>File Proposal</label><br>
                        <input type="file" name="file_tiket">
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm"> Save </button>
                    <button type="reset" class="btn btn-danger btn-sm"> Reset </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-tiket">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yakin Konfirm Tiket Ini?</h5>
                <button class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('tiket/save_tiket_waiting') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_tiket" id="id_tiket" class="form-control">
                    <input type="hidden" name="status_tiket" value="1" class="form-control">

                    <button type="submit" class="btn btn-primary btn-sm"> Save </button>
                    <button type="reset" class="btn btn-danger btn-sm"> Reset </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-reply">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Tanggapan</h5>
                <button class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="<?= base_url('tiket/save_tanggapan') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_tiket" id="id_tiket_id" class="form-control">
                    <input type="hidden" name="status_tiket" value="2" class="form-control">
                    <div class="form-group">
                        <label for="keluhan">Keluhan</label>
                        <input type="text" id="judul_tiket" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" class="form-control" readonly></textarea>
                    </div>

                    <div class="form-group">
                        <label for="tanggapan">Tanggapan</label>
                        <textarea name="tanggapan" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="tanggapan">File tanggapan</label>
                        <input type="file" name="file tanggapan" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm"> Reply Message </button>
                    <button type="reset" class="btn btn-danger btn-sm"> Reset </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalclosetiket">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yakin Tutup Tiket Ini?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('tiket/save_close_tiket') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_tiket" id="closetiket" class="form-control">
                    <input type="hidden" name="status_tiket" value="3" class="form-control">

                    <button type="submit" class="btn btn-primary btn-sm"> Save </button>
                    <button type="reset" class="btn btn-danger btn-sm"> Reset </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '#select_tiket', function() {
            var id_tiket = $(this).data('id_tiket')
            var status_tiket = $(this).data('status_tiket')


            $('#id_tiket').val(id_tiket)
            $('#status_tiket').val(status_tiket)
        })

        $(document).on('click', '#reply-message', function() {
            var id_tiket = $(this).data('id_tiket')
            var id_tiket_id = $(this).data('id_tiket_id')
            var judul_tiket = $(this).data('judul_tiket')
            var deskripsi = $(this).data('deskripsi')


            $('#id_tiket').val(id_tiket)
            $('#id_tiket_id').val(id_tiket_id)
            $('#judul_tiket').val(judul_tiket)
            $('#deskripsi').val(deskripsi)
        })

        $(document).on('click', '#close-tiket', function() {
            var closetiket = $(this).data('closetiket')
            var closestatus = $(this).data('closestatus')

            $('#closetiket').val(closetiket)
            $('#closestatus').val(closestatus)
        })
    })
</script>