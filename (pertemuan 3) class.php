<?php
class buku{
    private string $judul;
    private string $penulis;
    private bool $tersedia = true;

    public function __construct(string $judul, String $penulis) {
        $this->judul = $judul;
        $this->penulis = $penulis;
    }

    public function tampilkaninfo(): void{
        $status = $this->tersedia ? "tersedia" : "dipinjam";
        echo "judul: " .$this->judul. "<br>";
        echo "penulis: " .$this->penulis. "<br>";
        echo "status: " .$status. "<br>";
    }
    public function getJudul(): string {
    return $this->judul;
    }

    public function getPenulis(): string {
        return $this->penulis;
    }

    public function getTersedia(): bool {
        return $this->tersedia;
    }

    public function pinjam(): void {
        if($this->tersedia) {
            $this->tersedia = false;
            echo "Buku {$this->judul} berhasil dipinjam.<br>";
        }
        else{
            echo "Buku {$this->judul} sedang dipinjam.<br>";
        }
    }

    public function kembalikan(): void {
        if(!$this->tersedia){
            $this->tersedia = true;
            echo "buku {$this->judul} berhasil dikembalikan.<br>"; 
        }
        else{
            echo "Buku {$this->judul} sudah ada di perpustakaan.<br>";
        }
    }
}
$buku1 = new buku("OOP Dasar", "budi");
$buku2 = new buku("Laravel", "sari");
$buku3 = new buku("UML", "andi");
$buku1->tampilkaninfo();
// $buku1->tampilkaninfo();
// $buku1->pinjam();
// $buku1->pinjam();
// $buku1->kembalikan();

// class anggota{
//     public string $nama;
//     public string $status;
//     public int $NIP;

//     public function __construct(string $nama, string $status, int $NIP) {
//         $this->nama = $nama;
//         $this->status = $status;
//         $this->NIP = $NIP;
//     }

//     public function tampilkaninfo(){
//         echo "nama: ". $this->nama."<br>";
//         echo "status: ". $this->status."<br>";
//         echo "NIP: ". $this->NIP."<br>";
//     }
// }
// $anggota1 = new anggota("Rizky", "Admin", 202540);
// $anggota1->tampilkaninfo()
?>