<!-- TUGAS PERTEMUAN 3 - PEMROGRAMAN BERORIENTASI OBJEK - MEMBUAT 1 CLASS DARI TUGAS PERTEMUAN 2 -->
<!-- NAMA: RIZKY FARDANI DARMAWAN -->
<!-- NIM: 20251020040 -->
<!-- PRODI: TEKNIK INFORMATIKA 2/3 -->
<?php
//dalam studi kasus di pertemuan 2, saya memilih program proses peminjaman ruangan kampus, dan saya mengambil class ruangan
class ruangan{
    //Disini saya memakai 3 property untuk keterangan ruangan dan status ketersediaan ruangan 
    public string $nomorruangan;
    public string $fasilitas;
    public bool $statusketersediaan = true;

    //untuk data utama cunstruct, saya memanggil property atau atribut nomorruangan dan fasilitas
    public function __construct(string $nomorruangan, string $fasilitas){
        $this->nomorruangan = $nomorruangan;
        $this->fasilitas = $fasilitas;
    }

    //method awal saya memberi nama tampilkaninfo() untuk menampilkan info ruangan yang berisi nomor ruangan, fasilitas, dan status
    public function tampilkaninfo(): void{
        $status = $this->statusketersediaan ? "tersedia":"dipinjam";
        echo "----------------------------------------------------------<br>";
        echo "nomor ruangan: ". $this->nomorruangan. "<br>";
        echo "fasilitas: ".$this->fasilitas. "<br>";
        echo "status: ".$status. "<br>";
    }

    //method selanjutnya saya beri nama tandaiDipinjam() untuk menampilkan jika ruangan sedang dipinjam dengan mengubah status menjadi false
    public function tandaiDipinjam(): void {
        if($this->statusketersediaan) {
            $this->statusketersediaan = false;
            echo "Ruangan {$this->nomorruangan} berhasil dipinjam.<br>";
        }
        else{
            echo "Ruangan {$this->nomorruangan} sedang dipinjam.<br>";
        }
    }

    //method terakhir dari class ruangan adalah tandaiTersedia() untuk menampilkan jika ruangan sudah selesai digunakan atau waktu
    //peminjaman kadaluasa/habis sehingga ruangan akan tersedia kembali dengan status menjadi true kembali
    public function tandaiTersedia(): void {
        if(!$this->statusketersediaan){
            $this->statusketersediaan = true;
            echo "Ruangan {$this->nomorruangan} berhasil dikembalikan.<br>"; 
        }
        else{
            echo "Ruangan {$this->nomorruangan} tersedia.<br>";
        }
    }
}
echo "PEMINJAMAN RUANGAN UNIVERSITAS CATUR INSAN CENDEKIA <br>";
$ruangan1 = new ruangan("hub202", "120 kursi");
$ruangan1->tampilkaninfo();
$ruangan1->tandaiDipinjam();
$ruangan1->tandaiTersedia();

$ruangan2 = new ruangan("covention hall", "500 kursi");
$ruangan2->tampilkaninfo();
$ruangan2->tandaiDipinjam();
$ruangan2->tandaiTersedia();

?>