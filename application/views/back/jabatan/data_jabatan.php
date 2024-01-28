<div class="card">
    <div class="card-header">
        <h3 class="card-tittle"> Data Jabatan </h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Jabatan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($jabatan as $row) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->jabatan ?></td>
                        <td><a href="<?= base_url('jabatan/edit_jabatan/' . $row->id_jabatan) ?>" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"> </i>
                            </a>
                            <a onclick="return confirm('Yakin akan menghapus ?');" href="<?= base_url('jabatan/delete_jabatan/' . $row->id_jabatan) ?>" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"> </i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>