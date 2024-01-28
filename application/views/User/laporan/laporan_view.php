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
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-tittle"> Laporan </h3>
                    </div>

                    <div class="card-body">
                        <form action="<?= base_url('laporan/print_laporan') ?>" method="POST" target="_blank">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Awal</label>
                                        <input type="date" name="tgl_awal" id="tgl_awal" value="<?= date('Y-m-d') ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Akhir</label>
                                        <input type="date" name="tgl_akhir" id="tgl_akhir" value="<?= date('Y-m-d') ?>" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary btn-sm center"> PRINT </button>
                        </form>
                    </div>


                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> Data Proposal </h3>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Tiket</th>
                                <th>Judul</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>konfirmasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($laporan as $row) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->no_tiket ?></td>
                                    <td><?= $row->judul_tiket ?></td>
                                    <td>
                                        <a href="<?= base_url('laporan/view_pdf/' . $row->no_tiket) ?>" target="_blank">Buka File PDF</a>
                                    </td>
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
                                        <?php
                                        if ($row->status_tiket == '0') {
                                            echo  '<a href="javascript:void(0);" data-toggle="modal" data-target="#modal-tiket" id="select_tiket" 
                                                data-id_tiket="' . $row->id_tiket . '" 
                                                data-status_tiket="' . $row->status_tiket . '"
                                                class="btn btn-success btn-sm">
                                                    Confirm
                                                </a>';
                                        } else if ($row->status_tiket == '1') {
                                            echo  '<a href="javascript:void(0);" data-toggle="modal" data-target="#modalclosetiket" id="close-tiket" 
                                                    data-closetiket="' . $row->id_tiket . '" 
                                                    data-closetatus="' . $row->status_tiket . '"
                                                    class="btn btn-success btn-sm">
                                                        Terima
                                                    </a>
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-reply" id="reply-message" 
                                                    data-tiket_id="' . $row->id_tiket . '" 
                                                    data-id_tiket_id="' . $row->id_tiket . '"
                                                    data-judul_tiket="' . $row->judul_tiket . '"
                                                    data-deskripsi="' . $row->deskripsi . '"
                                                    class="btn btn-warning btn-sm">
                                                        Tolak
                                                    </a>';
                                        } else if ($row->status_tiket == '2') {
                                            echo  '<a href="javascript:void(0);" data-toggle="modal" data-target="#modalclosetiket" id="close-tiket" 
                                                    data-closetiket="' . $row->id_tiket . '" 
                                                    data-closetatus="' . $row->status_tiket . '"
                                                    class="btn btn-primary btn-sm">
                                                        Close Tiket
                                                    </a>';
                                        }
                                        ?>
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

<!-- modal/popup untuk konfirmasi bahwa tiket diterima -->
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
                <form action="<?= base_url('laporan/save_tiket_waiting') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_tiket" id="id_tiket" class="form-control">
                    <input type="hidden" name="status_tiket" value="1" class="form-control">

                    <button type="submit" class="btn btn-primary btn-sm"> Save </button>
                    <button type="reset" class="btn btn-danger btn-sm"> Reset </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal/popup untuk memberikan reply terhadap tiket yang ada -->
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
                <form action="<?= base_url('laporan/save_tanggapan') ?>" method="POST" enctype="multipart/form-data">
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

                    <button type="submit" class="btn btn-primary btn-sm"> Reply Message </button>
                    <button type="reset" class="btn btn-danger btn-sm"> Reset </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal/popup untuk menutup tiket bahwa tiket sudah selesai -->
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
                <form action="<?= base_url('laporan/save_close_tiket') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_tiket" id="closetiket" class="form-control">
                    <input type="hidden" name="status_tiket" value="3" class="form-control">
                    <input type="hidden" name="tanggapan" value="Proposal Dana Hibah Diterima" class="form-control">

                    <button type="submit" class="btn btn-primary btn-sm"> Save </button>
                    <button type="reset" class="btn btn-danger btn-sm"> Reset </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // script tombol konfirmasi tiket
        $(document).on('click', '#select_tiket', function() {
            var id_tiket = $(this).data('id_tiket')
            var status_tiket = $(this).data('status_tiket')


            $('#id_tiket').val(id_tiket)
            $('#status_tiket').val(status_tiket)
        })
        // script tombol reply message
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
        // script tombol close tiket
        $(document).on('click', '#close-tiket', function() {
            var closetiket = $(this).data('closetiket')
            var closestatus = $(this).data('closestatus')

            $('#closetiket').val(closetiket)
            $('#closestatus').val(closestatus)
        })
    })
</script>