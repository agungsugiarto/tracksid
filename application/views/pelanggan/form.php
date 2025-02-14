<style type="text/css">
	.teks-form {
		padding-top: 7px;
		padding-left: 0px;
	}
	textarea {
		resize: vertical;
	}
	.select2-selection__rendered,
	.select2-results__option {
		font-size: 14px !important;
	}
	.alert { margin-top: 10px; }
	.profile-user-img {width: 200px;}
</style>
<link rel="stylesheet" href="<?= base_url('assets/jquery/css/jquery.fancybox.min.css') ?>" />
<script src="<?= base_url('assets/jquery/js/jquery-3.2.1.js')?>"></script>
<script src="<?= base_url('assets/jquery/js/jquery.fancybox.min.js') ?>"></script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Pelanggan <small>Tambah Pelanggan</small></h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('')?>"><i class="fa fa-home"></i> Dashboard</a></li>
			<li><a href="<?= site_url('pelanggan')?>"> Daftar Pelanggan</a></li>
			<li class="active">Tambah Pelanggan</li>
		</ol>
	</section>
	<section class="content container-fluid" id="maincontent">
		<div class="box box-info">
			<div class="box-header with-border">
				<a href="<?= site_url('pelanggan')?>" class="btn btn-social btn-flat btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-arrow-circle-left"></i> Kembali Ke Daftar Pelanggan</a>
				<?php if ($error): ?>
					<div class="container-fluid">
				    <div class="row">
			        <div class="col-md-10 col-md-offset-1">
								<div id="alert" class="alert alert-danger" role="alert">
									<?= $error;?>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<?= form_open_multipart(site_url("pelanggan/form/".($id_pelanggan ?: $pelanggan['id'])), ['id' => 'validasi', 'class' => 'form-horizontal', 'method' => 'POST']);?>
				<input type="hidden" id="ubah_desa" name="ubah_desa" value="">
				<div class="box-body">
					<div class="form-group">
						<label for="customerid" class="col-md-2 control-label"><span class="text-danger"></span>Customer ID</label>
						<div class="col-md-2">
							<input type="text" readonly id="customerid" name="customerid" class="form-control" placeholder="Customer ID" value="<?=$pelanggan['id']?>"/>
							<span class="text-danger"><?= form_error('customerid');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="domain" class="col-md-2 control-label"><span class="text-danger">*</span>Domain</label>
						<div class="col-md-5">
							<input type="text" id="domain" name="domain" class="form-control" placeholder="Contoh: cigelam.desa.id" value="<?= $this->input->post('domain') ?: $pelanggan['domain']?>"/>
							<span class="text-danger"><?= form_error('domain');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="id_desa" class="col-md-2 control-label"><span class="text-danger">*</span>Desa</label>
						<div class="col-md-5">
					  	<select class="form-control required input-sm select2-desa-ajax" name="id_desa" style ="width:100%;" data-url="<?= site_url('desa/list_desa_ajax')?>" onchange="$('#ubah_desa').val('1'); formAction('validasi')">
								<?php if ($desa): ?>
									<option value="<?= $desa['id']?>" selected><?= $desa['nama_desa'].' - '.$desa['nama_kabupaten']?></option>
								<?php endif;?>
							</select>
							<span class="text-danger"><?= form_error('id_desa');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="nama" class="col-md-2 control-label"><span class="text-danger">*</span>Nama Kontak</label>
						<div class="col-md-5">
							<input type="text" name="nama" value="<?= $this->input->post('nama') ?: $pelanggan['nama'] ?>" class="form-control" placeholder="Nama kontak pengelola dari desa"/>
							<span class="text-danger"><?= form_error('nama');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="no_hp" class="col-md-2 control-label"><span class="text-danger">*</span>No. HP</label>
						<div class="col-md-5">
							<input type="text" name="no_hp" value="<?= $this->input->post('no_hp') ?: $pelanggan['no_hp'] ?>" class="form-control" placeholder="Nomor HP kontak desa"/>
							<span class="text-danger"><?= form_error('no_hp');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-md-2 control-label">Email</label>
						<div class="col-md-5">
							<input type="text" name="email" value="<?= $this->input->post('email') ?: $pelanggan['email'] ?>" class="form-control" placeholder="Alamat email kontak desa"/>
							<span class="text-danger"><?= form_error('email');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="jenis_langganan" class="col-md-2 control-label"><span class="text-danger">*</span>Jenis Langganan</label>
						<div class="col-md-3">
							<select name="jenis_langganan" class="form-control">
								<option value="">Pilih Jenis Langganan</option>
								<?php foreach ($jenis_pelanggan as $kode => $jenis): ?>
									<option value="<?= $kode ?>" <?= selected($kode, $this->input->post('jenis_langganan') ?: $pelanggan['jenis_langganan']) ?>><?= ucwords($jenis) ?></option>
								<?php endforeach; ?>
							</select>
							<span class="text-danger"><?= form_error('jenis_langganan');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="tgl_mulai" class="col-md-2 control-label"><span class="text-danger">*</span>Tgl Mulai Langganan</label>
						<div class="col-md-5">
							<div class="input-group input-group-sm date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input title="Tanggal Mulai" class="form-control input-sm required tgl_mulai" name="tgl_mulai" type="text" value="<?= $this->input->post('tgl_mulai') ?: tgl_out($pelanggan['tgl_mulai'])?>"/>
							</div>
							<span class="text-danger"><?= form_error('tgl_mulai');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="tgl_akhir" class="col-md-2 control-label"><span class="text-danger">*</span>Tgl Berakhirnya Langganan</label>
						<div class="col-md-5">
							<div class="input-group input-group-sm date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input title="Tanggal Akhir" class="form-control input-sm required tgl_akhir" name="tgl_akhir" type="text" value="<?= $this->input->post('tgl_akhir') ?: tgl_out($pelanggan['tgl_akhir'])?>"/>
							</div>
							<span class="text-danger"><?= form_error('tgl_akhir');?></span>
						</div>
					</div>
					<div class="form-group">
						<?php if ($pelanggan['bukti']): ?>
							<input type="hidden" name="bukti_lama" value="<?= $pelanggan['bukti']?>">
							<a data-fancybox="images" data-caption="Bukti Pembayaran" href="<?= ambil_bukti($pelanggan['bukti'], 'kecil')?>"><img class="profile-user-img img-responsive" src="<?= ambil_bukti($pelanggan['bukti'], 'kecil')?>" alt="Bukti Pembayaran"></a>
							<p class="text-center"><label class="control-label"><input type="checkbox" name="hapus_bukti" value="<?= $pelanggan ['bukti']?>" /> Hapus Bukti</label></p>
						<?php else: ?>
							<img class="profile-user-img img-responsive" src="<?= base_url()?>assets/files/logo/home.png" alt="Belum Ada Bukti">
						<?php endif; ?>
						<label for="status_langganan" class="col-md-2 control-label">Bukti Pembayaran</label>
						<div class="col-md-3">
							<input type="file" name="bukti" size="20" />
							<span class="text-danger"><?= form_error('status_langganan');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="status_langganan" class="col-md-2 control-label">Status Langganan</label>
						<div class="col-md-3">
							<select name="status_langganan" class="form-control">
								<option value="">Pilih Status Langganan</option>
								<?php foreach ($status_langganan as $key => $nama): ?>
									<option value="<?= $key ?>" <?= selected($key, $this->input->post('status_langganan') ?: $pelanggan['status_langganan']) ?>><?= ucwords($nama) ?></option>
								<?php endforeach; ?>
							</select>
							<span class="text-danger"><?= form_error('status_langganan');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="pelaksana" class="col-md-2 control-label"><span class="text-danger">*</span>Pelaksana</label>
						<div class="col-md-3">
							<select name="pelaksana" class="form-control">
								<option value="">Pilih Pelaksana</option>
								<?php foreach ($pelaksana as $key => $nama): ?>
									<option value="<?= $key ?>" <?= selected($key, $this->input->post('pelaksana') ?: $pelanggan['pelaksana']) ?>><?= $nama ?></option>
								<?php endforeach; ?>
							</select>
							<span class="text-danger"><?= form_error('pelaksana');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="token" class="col-md-2 control-label">API Key</label>
						<div class="col-md-5">
							<textarea rows="3" class="form-control input-sm" name="token" id="token" placeholder="Token"><?= $this->input->post('token') ?: $pelanggan['token'] ?></textarea>
							<span class="text-danger"><?= form_error('token');?></span>
						</div>
						<button class="btn btn-social btn-flat btn-info btn-sm" id="btn_simpan"><i class='fa fa-key'></i>Buat Key</button>
						<button type="button" class="btn btn-social btn-flat btn-primary btn-sm" onclick="copyToClipboard('#token')"><i class='fa fa-key'></i>Salin ke Clipboard</button>
					</div>
				</div>
				<div class="box-footer">
					<button type="reset" class="btn btn-social btn-flat btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
					<button type="submit" class="btn btn-social btn-flat btn-info btn-sm pull-right"><i class="fa fa-check"></i> Simpan</button>
				</div>
			</form>
		</div>
	</section>
</div>
<script type="text/javascript">
  setTimeout(function () {
    // Closing the alert
    $('#alert').alert('close');
  }, 5000);

	$('#btn_simpan').on('click', function() {
		var id = $('#customerid').val();
		$.ajax({
			url: '<?= site_url('pelanggan/generate_token')?>',
			type: 'POST',
			dataType: 'JSON',
			data: {id:id},
			success: function(data){
				$('[name="token"]').val(data);
			}
		});
		return false;
	});

</script>
