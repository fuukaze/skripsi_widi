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
                                <div id="pdfViewer"></div>
                                <!-- <canvas id="pdfRenderer" style="border:1px solid black;"></canvas> -->
                                <object data="<?= base_url('assets/doc/tiket/' . $tiket->file_tiket); ?>" type="application/pdf" width="100%" height="600px">
                                    <p>Browser Anda tidak mendukung tampilan file PDF. Silakan <a href="nama_file.pdf">unduh file PDF</a> untuk melihatnya.</p>
                                </object>
                            </div>

                            <!-- <div class="col-6">
                                <p class="lead">Amount Due 2/22/2014</p>

                            </div> -->

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
<!-- <script>
    const url = "<?= base_url('assets/doc/tiket/' . $tiket->file_tiket); ?>";

    const loadingTask = pdfjsLib.getDocument(url);
    loadingTask.promise.then(function(pdf) {
        pdf.getPage(1).then(function(page) {
            const pdfViewer = document.getElementById('pdfViewer');
            const scale = 1.5;
            const viewport = page.getViewport({
                scale: scale
            });

            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;
            pdfViewer.appendChild(canvas);

            const renderContext = {
                canvasContext: context,
                viewport: viewport
            };

            page.render(renderContext);
        });
    });
</script> -->