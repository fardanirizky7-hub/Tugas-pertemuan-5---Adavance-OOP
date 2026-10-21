<?php

// ==========================================
// 1. INTERFACE (Kontrak Kemampuan / Can-Do)
// ==========================================
// Interface ini menetapkan aturan: objek apa pun yang "BisaDipesan" 
// wajib memiliki fungsi hitungBiaya() dan getDetailInfo().
interface BisaDipesan {
    public function hitungBiaya(): float;
    public function getDetailInfo(): string;
}


// ==========================================
// 2. ABSTRACT CLASS (Kerangka Dasar / Is-A)
// ==========================================
// Kelas utama untuk semua jenis ruangan. Bersifat abstract artinya 
// tidak bisa langsung dibuat objeknya (tidak bisa di-new Ruangan()).
abstract class Ruangan {
    // Pertemuan 3: Encapsulation (private/protected) agar data aman
    protected string $kodeRuang;
    protected string $namaRuang;
    protected int $kapasitas;

    // Constructor untuk mengisi data dasar ruangan
    public function __construct(string $kode, string $nama, int $kapasitas) {
        $this->kodeRuang = $kode;
        $this->namaRuang = $nama;
        $this->kapasitas = $kapasitas;
    }

    // Method biasa yang bisa diwariskan langsung ke anak-anaknya
    public function getNamaRuang(): string {
        return $this->namaRuang;
    }

    // Abstract method: Wajib di-override oleh kelas anak sesuai karakteristiknya
    abstract public function getFasilitasUtama(): string;
}


// ==========================================
// 3. INHERITANCE & OVERRIDING (Pewarisan & Ubah Perilaku)
// ==========================================
// Kelas RuanganKelas mewarisi Ruangan dan mengimplementasikan kontrak BisaDipesan.
class RuanganKelas extends Ruangan implements BisaDipesan {
    private bool $adaProyektor;

    public function __construct(string $kode, string $nama, int $kapasitas, bool $adaProyektor) {
        // Memanggil constructor dari parent (Ruangan)
        parent::__construct($kode, $nama, $kapasitas);
        $this->adaProyektor = $adaProyektor;
    }

    // Pertemuan 4/5: Overriding abstract method dari parent
    public function getFasilitasUtama(): string {
        $statusProyektor = $this->adaProyektor ? "Dilengkapi Proyektor HD" : "Tanpa Proyektor";
        return "Papan tulis standar, kursi kuliah, <br>" . $statusProyektor;
    }

    // Mengimplementasikan contract dari interface BisaDipesan
    public function hitungBiaya(): float {
        // Ruangan kelas kampus biasanya gratis untuk mahasiswa, jadi biaya 0
        return 0.0;
    }

    public function getDetailInfo(): string {
        return "Ruang Kelas: {$this->namaRuang} (Kapasitas: {$this->kapasitas} orang)<br>";
    }
}


// Kelas RuanganLab juga mewarisi Ruangan dan mengimplementasikan BisaDipesan
class RuanganLab extends Ruangan implements BisaDipesan {
    private int $jumlahKomputer;

    public function __construct(string $kode, string $nama, int $kapasitas, int $jumlahKomputer) {
        parent::__construct($kode, $nama, $kapasitas);
        $this->jumlahKomputer = $jumlahKomputer;
    }

    // Overriding abstract method dari parent
    public function getFasilitasUtama(): string {
        return "{$this->jumlahKomputer} Unit PC Spesifikasi Tinggi, AC, dan Jaringan LAN<br>";
    }

    // Mengimplementasikan contract dari interface BisaDipesan
    public function hitungBiaya(): float {
        // Lab khusus biasanya dikenakan biaya perawatan lab per jam/sesi (misal: Rp50.000)
        return 50000.0;
    }

    public function getDetailInfo(): string {
        return "Laboratorium Komputer: {$this->namaRuang} (Kapasitas: {$this->kapasitas} orang)<br>";
    }
}


// ==========================================
// 5. COMPOSITION (Hubungan Has-A / Memiliki)
// ==========================================
// Kelas KeranjangReservasi bertugas menampung banyak item yang mengimplementasikan BisaDipesan.
class KeranjangReservasi {
    // Array ini menyimpan objek-objek ruangan (Composition: Keranjang "memiliki" item ruangan)
    private array $daftarItem = [];

    // Memasukkan objek yang memenuhi syarat kontrak BisaDipesan ke dalam keranjang
    public function tambahItem(BisaDipesan $item): void {
        $this->daftarItem[] = $item;
    }

    // Menghitung total seluruh biaya reservasi dari semua item di dalam keranjang
    public function hitungTotalBiaya(): float {
        $total = 0;
        foreach ($this->daftarItem as $item) {
            $total += $item->hitungBiaya();
        }
        return $total;
    }

    // Menampilkan daftar item secara polimorfis
    public function cetakRingkasanReservasi(): void {
        echo "=== RINGKASAN RESERVASI RUANGAN ===\n<br>";
        foreach ($this->daftarItem as $index => $item) {
            // Polymorphism: Memanggil method yang sama walau objeknya beda kelas (Kelas / Lab)
            echo ($index + 1) . ". " . $item->getDetailInfo() . "\n<br>";
            echo "   Fasilitas: " . $item->getFasilitasUtama() . "\n<br>";
            echo "   Biaya Sesi: Rp " . number_format($item->hitungBiaya(), 0, ',', '.') . "\n\n<br>";
        }
        echo "------------------------------------\n<br>";
        echo "Total Biaya Keseluruhan: Rp " . number_format($this->hitungTotalBiaya(), 0, ',', '.') . "\n";
    }
}


// ==========================================
// DEMO / CARA MENJALANKAN PROGRAM
// ==========================================

// 1. Membuat objek-objek konkret (Instansiasi)
$ruangTeori = new RuanganKelas("R.101", "Ruang Kuliah Teori A", 40, true);
$labKomputer = new RuanganLab("LAB.02", "Lab Jaringan Komputer", 25, 20);

// 2. Menggunakan Composition (Memasukkan objek-objek ke dalam Keranjang Reservasi)
$keranjangSaya = new KeranjangReservasi();
$keranjangSaya->tambahItem($ruangTeori);
$keranjangSaya->tambahItem($labKomputer);

// 3. Menjalankan fungsi dengan Polymorphism
// Keranjang akan memproses objek-objek tersebut secara otomatis tanpa peduli 
// apakah itu RuanganKelas atau RuanganLab, asalkan punya kontrak yang sama.
$keranjangSaya->cetakRingkasanReservasi();

?>