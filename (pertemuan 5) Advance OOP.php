<?php
class buku{
    public string $judul;
    public function __construct(string $judul){
        $this->judul = $judul;
    }
    public function caraAkses(): string{
        return "Akses Umum perpustakaan";
    }
}

class bukuFisik extends buku{
    public function caraAkses(): string{
        return "Baca langsung di meja perpustakaan atau pinjam bawa pulang";
    }
}

class bukuDigital extends buku{
    public function caraAkses(): string{
        return "unduh pdf dan baca melalui aplikasi perpustakaan";
    }
}

class bukuReferensi extends buku{
    public function caraAkses(): string{
        return "Hanya boleh dibaca di perpustakaan (tidak boleh dibawa pulang)";
    }
}
echo "===HASIL PRAKTIKUM 1===<br>";
$buku1 = new bukuFisik("python");
$buku2 = new bukuDigital("Ragnamok");
echo "judul: ". $buku1->judul. "<br>";
echo "cara akses: ".$buku1->caraAkses()."<br><br>";
echo "judul: ". $buku2->judul. "<br>";
echo "cara akses: ".$buku2->caraAkses()."<br><br>";


echo "===HASIL PRAKTIKUM 2===<br>";
function tampilkanAkses(buku $buku): void{
    echo "Buku: ".$buku->judul."<br>akses: ".$buku->caraAkses()."<br><br>", PHP_EOL;
}
$daftar = [
    new bukuFisik("Ragnamok"),
    new bukuDigital("Islam Ala Prabowo"),
    new bukuReferensi("10 dosa besar Soeharto")
];
foreach ($daftar as $item){
    tampilkanAkses($item);
}
?>