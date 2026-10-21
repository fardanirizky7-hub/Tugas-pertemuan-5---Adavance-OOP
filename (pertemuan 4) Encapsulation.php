<?php
class Anggota {
    private int $maksPinjaman = 3;

    public function setMaksPinjaman(int $jumlah): void {
        if ($jumlah < 1 || $jumlah > 10) {
        throw new InvalidArgumentException(
            "Batas pinjaman 1..10");
        }
        $this->maksPinjaman = $jumlah;
    }
}
