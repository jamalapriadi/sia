<?php
class Tanggal{
  public static function terbilang($angka) {
      // pastikan kita hanya berususan dengan tipe data numeric
      $angka = (float)$angka;

      // array bilangan
      // sepuluh dan sebelas merupakan special karena awalan 'se'
      $bilangan = array(
              '',
              'satu',
              'dua',
              'tiga',
              'empat',
              'lima',
              'enam',
              'tujuh',
              'delapan',
              'sembilan',
              'sepuluh',
              'sebelas'
      );

      // pencocokan dimulai dari satuan angka terkecil
      if ($angka < 12) {
          // mapping angka ke index array $bilangan
          return $bilangan[$angka];
      } else if ($angka < 20) {
          // bilangan 'belasan'
          // misal 18 maka 18 - 10 = 8
          return $bilangan[$angka - 10] . ' belas';
      } else if ($angka < 100) {
          // bilangan 'puluhan'
          // misal 27 maka 27 / 10 = 2.7 (integer => 2) 'dua'
          // untuk mendapatkan sisa bagi gunakan modulus
          // 27 mod 10 = 7 'tujuh'
          $hasil_bagi = (int)($angka / 10);
          $hasil_mod = $angka % 10;
          return trim(sprintf('%s puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
      } else if ($angka < 200) {
          // bilangan 'seratusan' (itulah indonesia knp tidak satu ratus saja? :))
          // misal 151 maka 151 = 100 = 51 (hasil berupa 'puluhan')
          // daripada menulis ulang rutin kode puluhan maka gunakan
          // saja fungsi rekursif dengan memanggil fungsi terbilang(51)
          return sprintf('seratus %s', terbilang($angka - 100));
      } else if ($angka < 1000) {
          // bilangan 'ratusan'
          // misal 467 maka 467 / 100 = 4,67 (integer => 4) 'empat'
          // sisanya 467 mod 100 = 67 (berupa puluhan jadi gunakan rekursif terbilang(67))
          $hasil_bagi = (int)($angka / 100);
          $hasil_mod = $angka % 100;
          return trim(sprintf('%s ratus %s', $bilangan[$hasil_bagi], terbilang($hasil_mod)));
      } else if ($angka < 2000) {
          // bilangan 'seribuan'
          // misal 1250 maka 1250 - 1000 = 250 (ratusan)
          // gunakan rekursif terbilang(250)
          return trim(sprintf('seribu %s', terbilang($angka - 1000)));
      } else if ($angka < 1000000) {
          // bilangan 'ribuan' (sampai ratusan ribu
          $hasil_bagi = (int)($angka / 1000); // karena hasilnya bisa ratusan jadi langsung digunakan rekursif
          $hasil_mod = $angka % 1000;
          return sprintf('%s ribu %s', terbilang($hasil_bagi), terbilang($hasil_mod));
      } else if ($angka < 1000000000) {
          // bilangan 'jutaan' (sampai ratusan juta)
          // 'satu puluh' => SALAH
          // 'satu ratus' => SALAH
          // 'satu juta' => BENAR
          // @#$%^ WT*

          // hasil bagi bisa satuan, belasan, ratusan jadi langsung kita gunakan rekursif
          $hasil_bagi = (int)($angka / 1000000);
          $hasil_mod = $angka % 1000000;
          return trim(sprintf('%s juta %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
      } else if ($angka < 1000000000000) {
          // bilangan 'milyaran'
          $hasil_bagi = (int)($angka / 1000000000);
          // karena batas maksimum integer untuk 32bit sistem adalah 2147483647
          // maka kita gunakan fmod agar dapat menghandle angka yang lebih besar
          $hasil_mod = fmod($angka, 1000000000);
          return trim(sprintf('%s milyar %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
      } else if ($angka < 1000000000000000) {
          // bilangan 'triliun'
          $hasil_bagi = $angka / 1000000000000;
          $hasil_mod = fmod($angka, 1000000000000);
          return trim(sprintf('%s triliun %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
      } else {
          return 'Wow...';
      }
  }
}
