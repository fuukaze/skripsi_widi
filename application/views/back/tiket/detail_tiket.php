<div class="content-wrapper">
    <section class="conten-header">
        <div class="contianer-fluid">
            <div class="row mb-5">
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <h5>Proposal: <?= $tiket->no_tiket ?></h5>
                    </div>


                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-file"></i> PROPOSAL
                                    <small class="float-right">Date: <?= $tiket->tgl_daftar ?></small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                From
                                <address>
                                    <strong><?= $tiket->username; ?></strong><br>
                                    <b>Divisi</b> : <?= $tiket->divisi ?><br>
                                    <b>Jabatan</b>: <?= $tiket->jabatan ?><br>
                                    <b>Email</b> : <?= $tiket->email ?>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Status Tiket</b> :
                                <?php
                                if ($tiket->status_tiket == '0') {
                                    echo '<span class= "badge badge-warning">waiting...</span>';
                                } else if ($tiket->status_tiket == '1') {
                                    echo '<span class= "badge badge-info">process...</span>';
                                } else if ($tiket->status_tiket == '2') {
                                    echo '<span class= "badge badge-success">Replied...</span>';
                                } else {
                                    echo '<span class= "badge badge-danger">complete</span>';
                                }
                                ?>
                                <br>
                                <br>
                                <b>Proposal:</b> <?= $tiket->no_tiket ?>
                                <br>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label for="">Pengajuan Proposal</label>
                                <input type="text" value="<?= $tiket->judul_tiket ?>" readonly class="form-control">
                                <label for="">Keterangan lengkap</label>
                                <textarea rows="6" readonly class="form-control"><?= $tiket->deskripsi ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="">Tanggapan Verifikator</label>
                                <textarea rows="6" readonly class="form-control"><?= $tiket->tanggapan ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="">File PDF</label>
                                <?php
                                // Lokasi file PDF
                                $lokasi_file = base_url('assets/doc/tiket/' . $tiket->file_tiket);
                                ?>

                                <div id="pdfViewer"></div>

                                <input type="text" readonly name="judul_tiket" value="<?= $tiket->file_tiket ?>" class="form-control">

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
</div>
</div>

</div>
<script>
    $(document).ready(function() {
        var options = {
            pdfOpenParams: {
                view: 'FitV',
                page: '1'
            },
            fallbackLink: '<p>This browser does not support inline PDFs. Please download the PDF to view it: <a href="' + '<?= $lokasi_file; ?>' + '">Download PDF</a></p>'
        };
        PDFObject.embed("<?= $lokasi_file; ?>", "#pdfViewer", options);
    });
</script>