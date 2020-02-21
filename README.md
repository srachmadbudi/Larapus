# SoalShiftSISOP20_modul1_D09
```
Rachmad Budi Santoso    05111840000122
Khofifah Nurlaela       05111840000025
```

## soal1
> Whits adalah seorang mahasiswa teknik informatika. Dia mendapatkan tugas praktikum
untuk membuat laporan berdasarkan data yang ada pada file “Sample-Superstore.tsv”.
Namun dia tidak dapat menyelesaikan tugas tersebut. Laporan yang diminta berupa :
>- a. Tentukan wilayah bagian (region) mana yang memiliki keuntungan (profit) paling
sedikit!
>- b. Tampilkan 2 negara bagian (state) yang memiliki keuntungan (profit) paling
sedikit berdasarkan hasil poin a!
>- c. Tampilkan 10 produk (product name) yang memiliki keuntungan (profit) paling
sedikit berdasarkan 2 negara bagian (state) hasil poin b!

> Whits memohon kepada kalian yang sudah jago mengolah data untuk mengerjakan
laporan tersebut. *Gunakan Awk dan Command pendukung

### 1.a
```
#!/bin/bash

#number1a
onea=$(awk -F "\t" '
{groupby[$13]+=$21}
END {
        for(reg in groupby) {
                print groupby[reg], reg
        }
}
' Sample-Superstore.tsv | sort -g | head -2 | tail -1)

region=$(cut -d ' ' -f2 <<<"$onea")
echo -e "1.a) Region dengan profit terkecil adalah $region\n"
```
Pada bagian 1.a ini kita sebagai yang sudah jago mengolah data membantu Whits untuk mentukan wilayah bagian (region) mana yang memiliki keuntungan (profit) paling sedikit.
```
onea=$(awk -F "\t" '
```
Pada syntax tersebut kami menggunakan awk untuk membaca data dari file berdasarkan separator tab `\t` sebagai pemisahnya.

Selanjutnya, syntax `{groupby[$13]+=$21}` berfungsi untuk mengelompokkan dan menambahkan isi array berdasarkan profit pada kolom `$21` dari setiap region pada kolom `$13`.

```
END {
        for(reg in groupby) {
                print groupby[reg], reg
        }
}
```
Pada bagian END, kami melakukan looping untuk menampilkan seluruh profit `groupby[reg]` dari setiap region `reg`.

`sort -g` Mengurutkan data secara general, termasuk positif dan negatif.
`head -2` Menampilkan 2 data teratas dengan profit terkecil.
`tail -1` Menampilkan 1 data dari bawah.

Hal ini dilakukan karena kami melakukan perhitungan sejak kolom pertama, dimana pada kolom `$13` dimulai dengan title `region` yang berisi profit terkecil karena tidak memiliki data atau dengan kata lain berisi string huruf bukan angka sehingga menjadi yang terkecil. Untuk mengabaikan judul kolom tersebut maka digunakanlah cara diatas.

```
region=$(cut -d ' ' -f2 <<<"$onea")
echo -e "1.a) Region dengan profit terkecil adalah $region\n"
```
Syntax diatas berfungsi untuk memisahkan komponen dari hasil pencarian yang dilakukan (Jumlah profit[spasi]Region).
`cut -d ''` Memisahkan komonen berdasarkan spasi, `-f2` menampilkan field kedua dari komponen tersebut (hanya nama regionnya saja yang ditampilkan).


### 1.b
```
#______________________________________________________________________
#number1b
oneb=$(awk -F "\t" -v reg="$region" '
$13 ~ reg {
        groupby[$11]+=$21
}
END {
        for( state in groupby ) {
                print groupby[state], state
        }
}
' Sample-Superstore.tsv | sort -g | head -2)

state1=$(cut -d $'\n' -f1 <<<"$oneb")
state1=$(cut -d ' ' -f2 <<<"$state1")
state2=$(cut -d $'\n' -f2 <<<"$oneb")
state2=$(cut -d ' ' -f2 <<<"$state2")
echo -e "1.b) State dengan profit terkecil adalah $state1 dan $state2\n"
```
Pada bagian 1.b ini kita sebagai yang sudah jago mengolah data membantu Whits untuk mentukan 2 negara bagian (state) yang memiliki keuntungan (profit) paling sedikit berdasarkan hasil poin a.

```
oneb=$(awk -F "\t" -v reg="$region" '
```
Pada syntax tersebut kami menggunakan awk untuk membaca data dari file berdasarkan separator tab `\t` sebagai pemisahnya dan menggunakan data `$region` yang sudah diperoleh pada bagian a.

```
$13 ~ reg {
        groupby[$11]+=$21
}
```
Selanjutnya, syntax `{groupby[$13]+=$21}` berfungsi untuk mengelompokkan dan menambahkan isi array berdasarkan profit pada kolom `$21` dari setiap state pada kolom `$11` yang sebelumnya sudah difilter menggunakan data region(regex `~` mencari komponen yang mengandung `reg`).

```
END {
        for( state in groupby ) {
                print groupby[state], state
        }
}
```
Pada bagian END, kami melakukan looping untuk menampilkan seluruh profit `groupby[state]` dari setiap negara bagian `state`.
`sort -g` Mengurutkan data secara general, termasuk positif dan negatif.
`head -2` Menampilkan 2 data teratas dengan profit terkecil. 

```
state1=$(cut -d $'\n' -f1 <<<"$oneb")
state1=$(cut -d ' ' -f2 <<<"$state1")
state2=$(cut -d $'\n' -f2 <<<"$oneb")
state2=$(cut -d ' ' -f2 <<<"$state2")
echo -e "1.b) State dengan profit terkecil adalah $state1 dan $state2\n"
```
Syntax diatas berfungsi untuk memisahkan komponen dari hasil pencarian yang dilakukan (Jumlah profit[spasi]State).
`cut -d $'\n'` Memisahkan komonen berdasarkan enter, `-f2` menampilkan field pertama dari komponen tersebut  `cut -d ' '` Memisahkan komonen berdasarkan spasi, `-f2` menampilkan field kedua dari komponen tersebut (hanya nama regionnya saja yang ditampilkan).


### 1.c
```
#_______________________________________________________________________
#number1c
onec=$(awk -F "\t" -v st1="$state1" -v st2="$state2" '
$11 ~ st1 || $11 ~ st2 {
        groupby[$17]+=$21
}
END {
        for( product in groupby ) {
                print groupby[product], product
        }
}
' Sample-Superstore.tsv | sort -g | head -10)

p1=$(cut -d $'\n' -f1 <<<"$onec")
p1=$(cut --complement -d ' ' -f1 <<<"$p1")
p2=$(cut -d $'\n' -f2 <<<"$onec")
p2=$(cut --complement -d ' ' -f1 <<<"$p2")
p3=$(cut -d $'\n' -f3 <<<"$onec")
p3=$(cut --complement -d ' ' -f1 <<<"$p3")
p4=$(cut -d $'\n' -f4 <<<"$onec")
p4=$(cut --complement -d ' ' -f1 <<<"$p4")
p5=$(cut -d $'\n' -f5 <<<"$onec")
p5=$(cut --complement -d ' ' -f1 <<<"$p5")
p6=$(cut -d $'\n' -f6 <<<"$onec")
p6=$(cut --complement -d ' ' -f1 <<<"$p6")
p7=$(cut -d $'\n' -f7 <<<"$onec")
p7=$(cut --complement -d ' ' -f1 <<<"$p7")
p8=$(cut -d $'\n' -f8 <<<"$onec")
p8=$(cut --complement -d ' ' -f1 <<<"$p8")
p9=$(cut -d $'\n' -f9 <<<"$onec")
p9=$(cut --complement -d ' ' -f1 <<<"$p9")
p10=$(cut -d $'\n' -f10 <<<"$onec")
p10=$(cut --complement -d ' ' -f1 <<<"$p10")
echo -e  "1.c) Produk yang memiliki profit paling sedikit berdasarkan negara bagian
     $state1 dan $state2 adalah sebagai berikut:\n
 -$p1\n -$p2\n -$p3\n -$p4\n -$p5\n -$p6\n -$p7\n -$p8\n -$p9\n -$p10\n"
```
