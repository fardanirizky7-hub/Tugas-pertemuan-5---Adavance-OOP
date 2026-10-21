<?php
// <!-- TUGAS PERTEMUAN 5 - PEMROGRAMAN BERORIENTASI OBJEK - IMPLEMENTASI ADVANCE OOP -->
// <!-- NAMA: RIZKY FARDANI DARMAWAN -->
// <!-- NIM: 20251020040 -->
// <!-- PRODI: TEKNIK INFORMATIKA 2/3 -->
//buat interface untuk memberi kotrak ke class turunan
interface bisaDipinjam{
    public function ajukanPeminjaman(): bool;
    public function getinfoRuangan(): string;
}

//buat abstract atau class induk ruangan, untuk peminjaman ruangan kampus
abstract class ruangan{
    protected string $namaruangan;
    protected string $fasilitas;
    protected bool $statusketersediaan;
    
    public function __construct(string $namaruangan, string $fasilitas, bool $statusketersediaan){
        $this->setnamaRuangan($namaruangan);
        $this->setFasilitas($fasilitas);
        $this->statusketersediaan = $statusketersediaan;
    }
    
    public function getNamaRuangan(): string {
        return $this->namaruangan;
    }
    public function getFasilitas(): string {
        return $this->fasilitas;
    }
    public function getStatusKetersediaan(): bool {
        return $this->statusketersediaan;
    }

    public function setnamaRuangan(string $namaruangan): void {
        if (trim($namaruangan) === "") {
            throw new InvalidArgumentException("Nama ruangan tidak boleh kosong!");
        }
        $this->namaruangan = $namaruangan;
    }

    public function setFasilitas(string $fasilitas): void {
        if (trim($fasilitas) === "") {
            throw new InvalidArgumentException("Fasilitas ruangan tidak boleh kosong!");
        }
        $this->fasilitas = $fasilitas;
    }

    public function tampilkaninfo(){
        $status = $this->statusketersediaan ? "tersedia" : "Dipinjam";
        echo "Nama ruangan: {$this->namaruangan} <br>";
        echo "Fasilitas: {$this->fasilitas} <br>";
        echo "Status: {$status} <br>";
    }

    //untuk method warisan memakai method aturan khusus
    public function aturankhusus(): string {
        return "Aturan peminjaman kelas";
    }
}

//buat class turunan, disini saya membuat class ruangKelas dan aula dan menambahkan kotrak bisaDipinjam()
class ruangKelas extends ruangan implements bisaDipinjam{
    public function aturankhusus(): string {
        return "Ruangan {$this->namaruangan} dipinjam untuk pembelajaran mata kuliah<br>";
    }
    // RUANG KELAS WAJIB MENYERTAKAN KONTRAK DARI INTERFACE
    public function ajukanPeminjaman(): bool {
        return true;
    }
    public function getinfoRuangan(): string {
        return "Ruang kelas {$this->namaruangan}<br>";
    }
}

class Aula extends ruangan implements bisaDipinjam{
    public function aturankhusus(): string {
        return "Ruangan {$this->namaruangan} dipinjam untuk kelas gabungan/acara besar<br>";
    }
    public function ajukanPeminjaman(): bool {
        return true;
    }
    public function getinfoRuangan(): string {
        return "Ruang aula {$this->namaruangan}<br>";
    }
}

//buat induk class anggota, untuk output keterangan anggota
abstract class anggota{
    protected string $namaanggota;
    protected string $nomorinduk;

    public function __construct(string $namaanggota, string $nomorinduk){
        $this->setnamaanggota($namaanggota);
        $this->setnomorinduk($nomorinduk);
    }

    public function setnamaanggota(string $namaanggota){
        if (trim($namaanggota) === "") {
            throw new InvalidArgumentException("Nama tidak boleh kosong!");
        }
        $this->namaanggota = $namaanggota;
    }

    public function setnomorinduk(string $nomorinduk){
        if (trim($nomorinduk) === "") {
            throw new InvalidArgumentException("Nomor induk tidak boleh kosong!");
        }
        $this->nomorinduk = $nomorinduk;
    }
    
    public function tampilkaninfo(): void {
        echo "Nama: {$this->namaanggota}<br>";
    }
    
    public function infonomorinduk(): string {
        return "Nomor Induk Anggota";
    }
}

//saya membuat class turunan anggota yaitu class mahasiswa dan dosen untuk membedakan identitas dan nomor induk
class mahasiswa extends anggota{
    public function infonomorinduk(): string {
        return "Identitas: Mahasiswa<br>NIM: {$this->nomorinduk}<br>";
    }
}

class dosen extends anggota{
    public function infonomorinduk(): string {
        return "Identitas: Dosen<br>NIDN: {$this->nomorinduk}<br>";
    }
}

//selanjutnya ada class peminjaman, disini tugasnya adalah composition untuk menyusun sitem
class peminjaman{
    private anggota $peminjam;
    private ruangan $ruanganyangdipinjam;
    private string $statuspeminjaman;

    public function __construct (anggota $peminjam, ruangan $ruanganyangdipinjam, string $statuspeminjaman){
        $this->peminjam = $peminjam;
        $this->ruanganyangdipinjam = $ruanganyangdipinjam;
        $this->statuspeminjaman = $statuspeminjaman;
    }

    public function cetakbuktipeminjaman(): void {
        echo "===== BUKTI PEMINJAMAN RUANGAN =====<br>";
        echo "Identitas Anggota<br>";
        $this->peminjam->tampilkaninfo();
        echo $this->peminjam->infonomorinduk();
        echo "--------------------------------<br>";
        echo "Aturan Peminjaman: " . $this->ruanganyangdipinjam->aturankhusus();
        $this->ruanganyangdipinjam->tampilkaninfo();
        echo "Status Pengajuan: <b>{$this->statuspeminjaman}</b><br>";
        echo "================================<br><br>";
    }
}

// EKSEKUSI
$aula = new Aula("Convention Hall", "AC, 120 kursi, mimbar", true);
$anggota2 = new mahasiswa("wancoy", "20241020013");
$transaksi0 = new peminjaman($anggota2, $aula, "Ditolak");
$transaksi0->cetakbuktipeminjaman();

$kelas = new ruangKelas("hub 12", "AC, 30 kursi, papan tulis", true);
$dosenGofar = new dosen("Gofar", "19880123");
$transaksi1 = new peminjaman($dosenGofar, $kelas, "Disetujui");
$transaksi1->cetakbuktipeminjaman();
?>