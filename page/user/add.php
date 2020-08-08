<div class="container mt-2">
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow">
				<div class="card-header bg-dark text-white">
					<div class="float-left">
						Tambah Data User
					</div>
					<div class="float-right">
						<a href="?page=user" class="btn-info btn-sm text-decoration-none">Kembali</a>
					</div>
				</div>
				<div class="card-body">
					<form method="post" enctype="multipart/form-data">
						<div class="col-md-8 offset-2">
							<div class="form-row form-group">
								<div class="col-md-6">
									<label for="level">Level User</label>
									<select name="level" id="level" class="form-control">
										<option value="">-- Pilih Level User --</option>
										<option value="Administrator">Administrator</option>
										<option value="Operator">Operator</option>
									</select>
								</div>
								<div class="col-md-6">
									<label for="nama">Nama User</label>
									<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama User" required>
								</div>
							</div>
							<div class="form-row form-group">
								<div class="col-md-6">
									<label for="telp">Telepon User</label>
									<input type="telp" name="telp" id="telp" class="form-control" placeholder="Telepon User" required>
								</div>
								<div class="col-md-6">
									<label for="email">Email User</label>
									<input type="email" name="email" id="email" class="form-control" placeholder="Email User" required>
								</div>
							</div>
							<div class="form-row form-group">
								<div class="col-md-6">
									<label for="foto">Foto User</label>
									<input type="file" name="foto" id="foto" class="form-control">
								</div>
								<div class="col-md-6">
									<label for="alamat">Alamat User</label>
									<input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat User" required>
								</div>
							</div>
							<div class="form-row form-group">
								<div class="col-md-6">
									<label for="username">Username</label>
									<input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
								</div>
								<div class="col-md-6">
									<label for="password">Password</label>
									<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
								</div>
							</div>
							<div class="float-right">
								<button name="btnSimpan" type="submit" class="btn btn-success">
									Simpan Data User
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php  
if (isset($_POST['btnSimpan'])) {
	$level = $_POST['level'];
	$nama = $_POST['nama'];
	$telp = $_POST['telp'];
	$email = $_POST['email'];
	$alamat = $_POST['alamat'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$asalFile = $_FILES['foto']['tmp_name'];
	$sizeFile = $_FILES['foto']['size'];
	$namaFile = $_FILES['foto']['name'];

	if (empty($level) || empty(trim($nama)) || empty(trim($telp)) || empty(trim($email)) || empty(trim($alamat)) || empty(trim($username)) || empty(trim($password))) {
		echo "<script>alert('Data Tidak Lengkap!');</script>";
	} else {
		
		if (empty($asalFile)) {
			echo "<script>alert('Maaf, Foto User Belum Dipilih!');</script>";
		} else {
			$ekstensiFile = ['jpg', 'png', 'jpeg'];
			$pecahNamaFile = explode('.', $namaFile);
			$ambilEkstensiFile = strtolower(end($pecahNamaFile));

			if (!in_array($ambilEkstensiFile, $ekstensiFile)) {
				echo "<script>alert('Maaf, File Yang Anda Upload Bukan Gambar!');</script>";
			} else {
				if (move_uploaded_file($asalFile, 'file/' . $namaFile)) {
					$sql = $conn->query("INSERT INTO users VALUES (NULL, '".$level."', '".$nama."', '".$telp."', '".$email."', '".$namaFile."', '".$alamat."', '".$username."', '".$password."')");
					if ($sql) {
						echo "<script>alert('Data User Berhasil Disimpan.');location='?page=user';</script>";
					} else {
						echo "<script>alert('Maaf, Data User Gagal Disimpan!');</script>";
					}
				} else {
					echo "<script>alert('Maaf, Foto User Gagal Diupload!');</script>";
				}
			}
			
		}

	}

}

?>