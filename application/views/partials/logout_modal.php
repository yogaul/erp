<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" jika anda ingin mengakhiri sesi.</div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
                    <a class="btn btn-sm btn-primary" href="<?php echo base_url().'login/logout' ?>"><i class="fa fa-power-off"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>

<!-- Ubah Password -->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <form action="<?php echo base_url().'login/ubah_password' ?>" method="post" accept-charset="utf-8">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Ubah Password</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="password_sekarang" class="text-primary"><b>Password Saat Ini</b></label>
                    <input type="password" name="password_sekarang" class="form-control" placeholder="Masukkan password saat ini..." required="">
                  </div>
                  <div class="form-group">
                    <label for="password_baru" class="text-primary"><b>Password Baru</b></label>
                    <input type="password" name="password_baru" class="form-control" placeholder="Masukkan password baru..." required="">
                  </div>
                  <div class="form-group">
                    <label for="konfirmasi_password" class="text-primary"><b>Konfirmasi Password Baru</b></label>
                    <input type="password" name="konfirmasi_password" class="form-control" placeholder="Konfirmasi password baru..." required="">
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                </div>
            </div>
          </form>
        </div>
</div>

<!-- Logout Delete Confirmation-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
      <div class="modal-footer">
        <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
        <a id="btn-delete" class="btn btn-sm btn-danger" href="#"><i class="fas fa-trash"></i> Hapus</a>
      </div>
    </div>
  </div>
</div>

<!-- Reject Confirmation-->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Stok yang di reject tidak akan bisa dikembalikan.</div>
      <div class="modal-footer">
        <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
        <a id="btn-reject" class="btn btn-sm btn-danger" href="#"><i class="fas fa-arrow-right"></i> Lanjutkan</a>
      </div>
    </div>
  </div>
</div>

<!-- Produk Modal -->
<div class="modal fade" id="produkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Masukkan Produk</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="col-12">
                  <a href="<?php echo base_url().'Produk/tambah_produk' ?>" class="btn btn-primary btn-sm float-right mt-3">Buat Produk Baru</a>
                </div>
                <div class="modal-body">
                  <div class="table-responsive">
                    <table class="table temp-produk" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Pilih</th>
                          <th>Kode Produk (SKU)</th>
                          <th>Nama Produk</th>
                          <th>Satuan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($produk as $value) {
                        ?>
                        <tr class="item-produk">
                          <td><input type="checkbox" data-kode="<?php echo $value->kode_produk; ?>" data-nama="<?php $value->nama_produk; ?>" data-satuan="<?php echo $value->unit; ?>" name="pilih[]" class="form-control" value="<?php echo $value->id_produk ?>"></td>
                          <td><?php echo $value->kode_produk; ?></td>
                          <td class="item-nama-produk"><?php echo $value->nama_produk; ?></td>
                          <td><?php echo $value->unit; ?></td>
                        </tr>
                        <?php
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary simpan-temp" type="button" data-dismiss="modal">Simpan</button>
                    <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
</div>

<!-- Set Limit Modal -->
<div class="modal fade" id="updateLimitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <form method="post" action="<?php echo base_url().'produk/update_limit' ?>" accept-charset="utf-8">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-primary" id="exampleModalLabel"><b>Update Limit Stok</b></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="kode_produk_limit" class="text-primary"><b>Kode Bahan <?php echo $this->uri->segment(3); ?></b></label>
                <input type="hidden" id="id_produk_limit" name="id_produk" value="">
                <input class="form-control" type="text" id="kode_produk_limit" name="kode_produk" readonly="">
            </div>
            <div class="form-group">
                <label for="nama_produk_limit" class="text-primary"><b>Nama Bahan <?php echo $this->uri->segment(3); ?></b></label>
                <input class="form-control" id="nama_produk_limit" type="text" name="nama_produk" readonly="">
            </div>
            <div class="form-group">
                <label for="limit_stok" class="text-primary"><b>Stok Saat Ini</b></label>
                <input type="number" step=".001" class="form-control" id="limit_stok" name="limit_stok" placeholder="Set limit stok...">
            </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</a>
        </div>
            </div>
    </form>
</div>
</div>