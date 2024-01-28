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
                        <h3 class="card-title">
                            Edit Laporan Tiket : <?= $laporan->no_tiket ?>
                        </h3>
                        <a href="<?= base_url('laporan') ?>" class="btn btn-danger btn-sm float-right"> X </a>
                    </div>
                    <div class="card-body">
                        <?php $this->session->flashdata('message'); ?>
                        <?= validation_errors() ?>
                        <form action="<?= base_url('laporan/update_laporan') ?>" method="POST">
                            <div class="input-group mb-3">
                                <input type="hidden" name="no_tiket" value="<?= $laporan->no_tiket ?>" class="form-control">
                                <input type="text" disabled name="judul_tiket" value="<?= $laporan->judul_tiket ?>" class="form-control">
                            </div>

                            <div class="input-group mb-3">
                                <textarea disabled name="deskripsi" value="<?= $laporan->deskripsi ?>" class="form-control"><?= $laporan->deskripsi ?></textarea>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="email" value="<?= $user->email ?>" class="form-control" placeholder="Email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <select name="jabatan_id" class="form-control">
                                    <option value="">--Pilih Jabatan--</option>
                                    <?php foreach ($jabatan as $key => $row) { ?>
                                        <option value="<?= $row->id_jabatan ?>" <?= $row->id_jabatan == $user->jabatan_id ? 'selected' : null ?>><?= $row->jabatan ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <select name="divisi_id" class="form-control">
                                    <option value="">--Pilih Divisi--</option>
                                    <?php foreach ($divisi as $key => $row) { ?>
                                        <option value="<?= $row->id_divisi ?>" <?= $row->id_divisi == $user->divisi_id ? 'selected' : null ?>><?= $row->divisi ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <select name="status_user" class="form-control">
                                    <option value="">Status User</option>
                                    <option value="1" <?= $user->status_user == '1' ? 'selected' : '' ?>>Active</option>
                                    <option value="0" <?= $user->status_user == '0' ? 'selected' : '' ?>>Non Active</option>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <select name="level_user" class="form-control">
                                    <option value="">Level User</option>
                                    <option value="2" <?= $user->level_user == '2' ? 'selected' : '' ?>>Admin</option>
                                    <option value="1" <?= $user->level_user == '1' ? 'selected' : '' ?>>User</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm"> Save </button>
                            <button type="reset" class="btn btn-danger btn-sm"> Reset </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>