<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Print Table</title>
    <style>
    /* CSS for print */
    @media print {

        /* Set paper size to A4 */
        @page {
            size: A4;
        }

        /* Ensure that content fits within A4 size */
        body {
            width: 210mm;
            height: 297mm;
            margin: 0;
            padding: 0;
            font-family: "Carlito", sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            font-size: 12pt;
        }
    }

    /* Style for screen view */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    .container {
        width: 210mm;
        margin: 0 auto;
        padding: 10mm;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        page-break-inside: auto;
        /* Membolehkan pemutusan halaman di dalam tabel */
    }

    tr {
        page-break-inside: avoid;
        /* Hindari pemutusan halaman di tengah baris tabel */
        page-break-after: auto;
    }

    thead {
        display: table-header-group;
        /* Pastikan header tabel muncul di setiap halaman */
    }

    tfoot {
        display: table-footer-group;
        /* Memastikan footer tabel muncul di setiap halaman, jika ada */
    }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Carlito&display=swap" rel="stylesheet" />
</head>

<body>
    <!-- Start of First Page -->
    <div class="container">
        <!-- Header Section -->
        <table class="header-table">
            <tr>
                <td class="no-border" style="text-align: center"><img src="dist/img/bast/jpc.png" alt="Logo JPC" /></td>
                <td class="no-border">
                    <div style="text-align: center; font-weight: bold">BERITA ACARA SERAH TERIMA INVENTARIS</div>
                    <div style="text-align: center; font-weight: bold">PT. JAKARTA PRIMA CRANES</div>
                    <div style="text-align: center">Nomor : IT/BAST/2023/05/02</div>
                </td>
                <td class="no-border" style="text-align: center"><img src="dist/img/bast/k3.png" alt="Logo k3"
                        style="width: 45px" /></td>
            </tr>
        </table>

        <!-- Information Section -->
        <table>
            <tr style="text-align: justify">
                <td colspan="4">Pada hari ini <b>Senin</b>, tanggal <b>12</b>, bulan <b>Agustus</b>, Tahun <b>2024</b>
                    akan dilakukan serah terima inventaris dengan rincian sebagai berikut.</td>
            </tr>
        </table>

        <!-- Pihak Yang Melakukan Serah Terima Section -->
        <table>
            <tr>
                <th colspan="4">Pihak Yang Melakukan Serah Terima</th>
            </tr>
            <tr>
                <th>Nama</th>
                <th>Departemen</th>
                <th>NIP</th>
                <th>Status</th>
            </tr>
            <tr>
                <td>M Nurhasan Mahmud</td>
                <td>HR & GA / IT</td>
                <td>JPC-JKT-825</td>
                <td>PIHAK PENERIMA</td>
            </tr>
            <tr>
                <td>Rudi Ibrahim</td>
                <td>HR & GA / IT</td>
                <td>JPC-JKT-276</td>
                <td>PIHAK PEMBERI</td>
            </tr>
        </table>

        <!-- Rincian Inventaris Diserahkan Section -->
        <table>
            <tr>
                <th colspan="5">Daftar Inventaris Diserahkan</th>
            </tr>
            <tr>
                <th>No.</th>
                <th>No. Inventaris</th>
                <th>Deskripsi</th>
                <th>Spesifikasi & Kelengkapan</th>
                <th>Gambar</th>
            </tr>
            <tr>
                <td>1</td>
                <td>RFK-2023-001</td>
                <td>Laptop LENOVO Ideapad Gaming 3-15ACH6 Laptop - Type 82K2 (1 Unit)</td>
                <td>
                    <ul>
                        <li>Processor: AMD Ryzen™ 5 5600H</li>
                        <li>Display: 15.6" FHD NVIDIA® GeForce RTX™ 3050 4GB</li>
                        <li>RAM: 1x 8 GB DDR4-3200</li>
                        <li>Storage: 1x 512 GB SSD PCIe SN : MP8VXBV5P</li>
                        <li>Warna: Shadow Black</li>
                        <li>Charger Laptop (1 Unit)</li>
                        <li>Tas Laptop Lenovo (1 Unit)</li>
                    </ul>
                </td>
                <td><img src="gambar_laptop.png" alt="Gambar Laptop" width="100" /></td>
            </tr>
        </table>

        <!-- Lisences Details Section -->
        <table>
            <tr>
                <th colspan="4">Daftar Lisensi Software Digunakan</th>
            </tr>
            <tr>
                <th>No.</th>
                <th>No. Lisensi</th>
                <th>Deskripsi</th>
                <th>Start Date / End Date</th>
            </tr>
            <tr>
                <td>1</td>
                <td>IT/LIC/2024/01/01</td>
                <td>LISENSI AEC 2024</td>
                <td>27/01/2024 - 27/01/2025</td>
            </tr>
        </table>

        <!-- Keterangan Tambahan Section -->
        <table>
            <tr>
                <th>Keterangan Tambahan</th>
            </tr>
            <tr>
                <td>Laptop inventaris untuk Karyawan baru</td>
            </tr>
        </table>

        <!-- Signature Section -->
        <table class="signature-table">
            <tr>
                <th colspan="4">
                    Tanda Tangan <br />
                    <span style="font-size: small; font-weight: lighter">Dengan menandatangani dokumen ini maka karyawan
                        setuju dengan ketentuan-ketentuan yang sudah di tetapkan perusahaan.</span>
                </th>
            </tr>
            <tr>
                <th style="text-align: center">Menyerahkan</th>
                <th style="text-align: center">Menerima</th>
                <th style="text-align: center">Mengetahui</th>
                <th style="text-align: center">Menyetujui</th>
            </tr>
            <tr style="height: 100px; font-weight: bold">
                <td
                    style="text-align: center; vertical-align: bottom; padding-bottom: 0; display: table-cell; width: 25%">
                    Rudi Ibrahim</td>
                <td
                    style="text-align: center; vertical-align: bottom; padding-bottom: 0; display: table-cell; width: 25%">
                    M Nurhasan Mahmud</td>
                <td
                    style="text-align: center; vertical-align: bottom; padding-bottom: 0; display: table-cell; width: 25%">
                    Ali Rakhman</td>
                <td
                    style="text-align: center; vertical-align: bottom; padding-bottom: 0; display: table-cell; width: 25%">
                    Bramantya Zain</td>
            </tr>
        </table>
    </div>

    <!-- Start of Second Page -->
    <div class="container">
        <!-- Rincian Inventaris Diserahkan Section -->
        <table>
            <tr>
                <th colspan="5">Daftar Tambahan Inventaris Diserahkan</th>
            </tr>
            <tr>
                <th>No.</th>
                <th>No. Inventaris</th>
                <th>Deskripsi</th>
                <th>Spesifikasi & Kelengkapan</th>
                <th>Gambar</th>
            </tr>
            <tr>
                <td>1</td>
                <td>IT/REG/2024/01/03</td>
                <td>MOUSE WIRELESS LOGITECH M190</td>
                <td>N/A</td>
                <td><img src="gambar_laptop.png" alt="Gambar Laptop" width="100" /></td>
            </tr>
        </table>

        <!-- Lisences Details Section -->
        <table>
            <tr>
                <th colspan="4">Daftar Tambahan Lisensi Software Digunakan</th>
            </tr>
            <tr>
                <th>No.</th>
                <th>No. Lisensi</th>
                <th>Deskripsi</th>
                <th>Start Date / End Date</th>
            </tr>
            <tr>
                <td>1</td>
                <td>IT/LIC/2024/01/01</td>
                <td>LISENSI AEC 2024</td>
                <td>27/01/2024 - 27/01/2025</td>
            </tr>
            <tr>
                <td>2</td>
                <td>IT/LIC/2024/02/01</td>
                <td>MICROSOFT OFFICE PRO PLUS 2021</td>
                <td>26/02/2024 - ∞</td>
            </tr>
        </table>

        <!-- System Info Section -->
        <!-- <table>
				<tr>
					<th colspan="1">VI. System Info</th>
				</tr>
				<tr>
					<td>
                        ------------------
                            System Information
                            ------------------
                                Time of this report: 6/23/2023, 16:54:38
                                        Machine name: JPC_IT
                                        Machine Id: {DC6BA44A-FCBD-4EA5-96F5-D6AF7CC1BC44}
                                    Operating System: Windows 11 Home Single Language 64-bit (10.0, Build 22000) (22000.co_release.210604-1628)
                                            Language: English (Regional Setting: English)
                                System Manufacturer: LENOVO
                                        System Model: 82K2
                                                BIOS: H3CN34WW(V2.04) (type: UEFI)
                                            Processor: AMD Ryzen 5 5600H with Radeon Graphics          (12 CPUs), ~3.3GHz
                                            Memory: 8192MB RAM
                            ---------------
                            Display Devices
                            ---------------
                                    Card name: NVIDIA GeForce RTX 3050 Laptop GPU
                                    Manufacturer: NVIDIA
                                    Chip type: NVIDIA GeForce RTX 3050 Laptop GPU
                                        DAC type: Integrated RAMDAC
                                    Device Type: Render-Only Device
                                    Device Key: Enum\PCI\VEN_10DE&DEV_25A2&SUBSYS_3A5D17AA&REV_A1
                                Device Status: 0180200A [DN_DRIVER_LOADED|DN_STARTED|DN_DISABLEABLE|DN_NT_ENUMERATOR|DN_NT_DRIVER] 
                            Device Problem Code: No Problem
                            Driver Problem Code: Unknown
                                Display Memory: 6991 MB
                            ------------------------
                            Disk & DVD/CD-ROM Drives
                            ------------------------
                                Drive: C:
                            Free Space: 414.1 GB
                            Total Space: 486.1 GB
                            File System: NTFS
                                Model: INTEL SSDPEKNW512GZL
                    </td>
				</tr>
			</table> -->

        <!-- Additional Signature Section -->
        <table class="signature-table">
            <tr>
                <th>Ketentuan-Ketentuan</th>
            </tr>
            <tr style="height: 100px">
                <td style="text-align: justify; padding-right: 30px">
                    <ol style="margin-left: 0">
                        <li>Karyawan bertanggung jawab atas keamanan dan kehati-hatian dalam menggunakan barang
                            inventaris terkait.</li>
                        <li>Karyawan harus menggunakan barang inventaris sesuai dengan kebijakan perusahaan, termasuk
                            untuk kepentingan kerja dan tidak untuk tujuan pribadi yang melanggar kebijakan perusahaan.
                        </li>
                        <li>Karyawan dilarang mengubah konfigurasi atau menginstal perangkat lunak lain pada laptop
                            tanpa izin dari departemen IT atau pihak berwenang lainnya.</li>
                        <li>Jika barang inventaris mengalami kerusakan atau masalah teknis lainnya yang disebabkan oleh
                            kelalaian karyawan tersebut dan tidak terjamin oleh garansi, maka biaya perbaikan dibebankan
                            kepada karyawan sesuai dengan kebijakan perusahaan.</li>
                        <li>Karyawan harus memahami bahwa pelanggaran terhadap ketentuan penggunaan barang inventaris
                            kantor dapat mengakibatkan sanksi sesuai dengan kebijakan perusahaan. 6. Jika karyawan
                            berhenti atau mengakhiri kerjasama dengan perusahaan, karyawan wajib mengembalikan barang
                            inventaris kantor sesuai dengan prosedur yang ditetapkan.</li>
                    </ol>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>