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

// fungsi validasi SN di form barang.php
function validateInitialManual() {
	var snInput = document.getElementById("initial").value;
	var snError = document.getElementById("initialError");
	var submitButton = document.getElementById("tambahUser");

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
	xhr.open("POST", "check-initial.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send("initialCheck=" + snInput);
}

//Melalukan pemindaian cookie secara otomatis jika cookie login sudah kadaluarsa
$(document).ready(function () {
	// Fungsi untuk memeriksa cookie
	function checkCookie() {
		// Ambil nilai cookie dengan nama "_beta_log"
		var betaLogCookie = getCookie("_beta_log");

		// Jika cookie tidak ada atau sudah kedaluwarsa
		if (!betaLogCookie) {
			// Lakukan pemindahan halaman ke login.php
			window.location.href = "login.php";
		}
	}

	// Fungsi untuk mendapatkan nilai cookie berdasarkan nama
	function getCookie(name) {
		var cookies = document.cookie.split(";");
		for (var i = 0; i < cookies.length; i++) {
			var cookie = cookies[i].trim();
			if (cookie.indexOf(name + "=") === 0) {
				return cookie.substring(name.length + 1);
			}
		}
		return null;
	}

	// Panggil fungsi checkCookie setiap 5 detik (5000 milidetik)
	setInterval(checkCookie, 1000);
});
