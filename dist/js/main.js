function hapusDetailBarang(id) {
	let confirmMessage = confirm("Yakin ingin menghapus data ini?");
	if (confirmMessage) {
		// jika user klik Yes
		window.location.href = "function.php?hapusDetailBarang=" + id;
	} else {
		// Jika user klik cancel
	}
}

function hapusDaftarBarang(id) {
	let confirmMessage = confirm("Yakin ingin menghapus data ini?, Dengan menghapus data ini, maka akan menghapus semua isi detail daftar barang juga.");
	if (confirmMessage) {
		// jika user klik Yes
		window.location.href = "function.php?dumpDaftarBarang=" + id;
	} else {
		// Jika user klik cancel
	}
}

// fungsi validasi SN di form tambah-laporan-barang-masuk.php
function validateSN() {
	var snInput = document.getElementById("sn").value;
	var snError = document.getElementById("snError");
	var submitButton = document.getElementById("tambahBarangMasuk");

	// Kirim permintaan AJAX ke file PHP untuk memeriksa keberadaan nomor unik di database
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var response = xhr.responseText;
			snError.innerHTML = response;

			// Nonaktifkan atau aktifkan tombol berdasarkan respons dari server
			submitButton.disabled = response.includes("sudah ada dalam database");
		}
	};
	xhr.open("POST", "check_sn.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send("sn=" + snInput);
}

// fungsi validasi SN di form barang.php
function validateSNManual() {
	var snInput = document.getElementById("snM").value;
	var snError = document.getElementById("snError");
	var submitButton = document.getElementById("tambahBarangInvManual");

	// Kirim permintaan AJAX ke file PHP untuk memeriksa keberadaan nomor unik di database
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var response = xhr.responseText;
			snError.innerHTML = response;

			// Nonaktifkan atau aktifkan tombol berdasarkan respons dari server
			submitButton.disabled = response.includes("sudah ada dalam database");
		}
	};
	xhr.open("POST", "check-sn-manual.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send("snBarang=" + snInput);
}
