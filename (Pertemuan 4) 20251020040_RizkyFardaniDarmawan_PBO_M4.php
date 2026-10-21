<!-- TUGAS PERTEMUAN 3 - PEMROGRAMAN BERORIENTASI OBJEK - MEMBUAT 1 CLASS DARI TUGAS PERTEMUAN 2 -->
<!-- NAMA: RIZKY FARDANI DARMAWAN -->
<!-- NIM: 20251020040 -->
<!-- PRODI: TEKNIK INFORMATIKA 2/3 -->
<?php

class Ruangan
{
    //ganti property yang tadinya public ke private
    private string $nomorRuangan;
    private string $fasilitas;
    private bool $statusKetersediaan;

    public function __construct(string $nomorRuangan, string $fasilitas, bool $statusKetersediaan) {
        $this->setNomorRuangan($nomorRuangan); //panggil set ruangan agar property tidk kosong
        $this->setFasilitas($fasilitas); //panggil set fasilitas agar property tidk kosong
        $this->statusKetersediaan = true;
    }

    public function getNomorRuangan(): string
    {
        return $this->nomorRuangan;
    }
    public function getFasilitas(): string
    {
        return $this->fasilitas;
    }
    public function getStatusKetersediaan(): bool
    {
        return $this->statusKetersediaan;
    }

    public function setNomorRuangan(string $nomorRuangan): void
    {
        if (trim($nomorRuangan) === "") {
            throw new InvalidArgumentException(
                "Nomor ruangan tidak boleh kosong!"
            );
        }
        $this->nomorRuangan = $nomorRuangan;
    }

    public function setFasilitas(string $fasilitas): void
    {
        if (trim($fasilitas) === "") {
            throw new InvalidArgumentException(
                "Fasilitas ruangan tidak boleh kosong!"
            );
        }
        $this->fasilitas = $fasilitas;
    }

    public function tampilkanInfo(): void
    {
        echo "Nomor Ruangan: " . $this->nomorRuangan . "<br>";
        echo "Fasilitas: " . $this->fasilitas . "<br>";
        echo "Status: " .
            ($this->statusKetersediaan ? "Tersedia" : "Dipinjam");
        echo "<br><br>";
    }

    // Method aksi untuk meminjam ruangan
    public function tandaiDinjam(): void{
        if (!$this->statusKetersediaan) {
            throw new LogicException(
                "Ruangan sedang dipinjam!"
            );
        }
        $this->statusKetersediaan = false;
        echo "Ruangan {$this->getNomorRuangan()} berhasil dipinjam!<br><br>";
    }

    // Method aksi untuk mengembalikan ruangan
    public function tandaiTersedia(): void{
        if ($this->statusKetersediaan) {
            throw new LogicException(
                "Ruangan belum dipinjam!"
            );
        }
        $this->statusKetersediaan = true;
        echo "Ruangan {$this->getNomorRuangan()} berhasil dikembalikan!<br><br>";
    }
}

try {
    $ruangan1 = new Ruangan("R101", "Proyektor, AC, Wi-Fi");
    $ruangan2 = new Ruangan("R202", "Komputer, AC");

    echo "<h3>RUANGAN 1</h3>";
    $ruangan1->tampilkanInfo();
    $ruangan1->tandaiDinjam();
    $ruangan1->tampilkanInfo();
    $ruangan1->tandaiTersedia();
    $ruangan1->tampilkanInfo();

    echo "<h3>RUANGAN 2</h3>";
    $ruangan2->tampilkanInfo();
    $ruangan2->tandaiDinjam();
    $ruangan2->tandaiDinjam();
    $ruangan2->tampilkanInfo();
    $ruangan2->tandaiTersedia();
    $ruangan2->tampilkanInfo();

} catch (InvalidArgumentException | LogicException $e) {
    echo "Error: " . $e->getMessage();
}

?>