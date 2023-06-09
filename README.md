# SIKK-RS
Sistem Informasi Ketersediaan Kamar Rumah Sakit di Surakarta.
_Hospital Room Availability Information System in Surakarta._

## Fitur
### Backend (v2)
Aplikasi SIKK-RS pada backend([v2](https://gitd3ti.vokasi.uns.ac.id/ibnudn/m3118039-webapps/-/tree/main/v2)) merupakan aplikasi yang diperuntukkan bagi admin dan/atau pegawai fasilitas kesehatan untuk melakukan manajemen data pada tiap fasilitas kesehatannya.
_The SIKK-RS application on the backend([v2](https://gitd3ti.vokasi.uns.ac.id/ibnudn/m3118039-webapps/-/tree/main/v2)) is an application intended for admins and/or health facility employees to manage data at each health facility._
#### Admin
- Manajemen data user,
- _User data management,_
- Manajemen data seluruh faskes,
- _Data management of all health facilities,_
- Manajemen data kapasitas seluruh faskes,
- _Capacity data management of all health facilities,_
- Manajemen data ketersediaan seluruh faskes.
- _Availability data management of all health facilities._
#### Pegawai (_Employee_)
- Manajemen data faskes,
- _Health facility data management,_
- Manajemen data kapasitas faskes,
- _Capacity data management of chosen health facility,_
- Manajemen data ketersediaan faskes.
- _Availability data management of chosen health facility._

### Frontend
Aplikasi SIKK-RS pada [frontend](https://gitd3ti.vokasi.uns.ac.id/ibnudn/m3118039-webapps/-/tree/main/sikk-rs) merupakan aplikasi yang diperuntukkan bagi masyarakat umum untuk memantau ketersediaan kamar rumah sakit yang ada di Kota Surakarta. Fitur yang tersedia pada frontend meliputi :
_The SIKK-RS application on [frontend](https://gitd3ti.vokasi.uns.ac.id/ibnudn/m3118039-webapps/-/tree/main/sikk-rs) is an application intended for the general public to monitor the availability of hospital rooms in Surakarta City. The features available on the frontend include:_
- Melihat ketersediaan kamar rumah sakit berdasarkan faskes,
- _View the availability of hospital rooms based on health facilities,_
- Melihat ketersediaan kamar rumah sakit berdasarkan kelas,
- _View the availability of hospital rooms by class,_
- Melihat titik lokasi faskes pada peta,
- _View map location on selected health facility,_
- Melihat ketersediaan kamar rumah sakit di setiap kelas yang ada pada faskes yang dipilih,
- _View the availability of hospital rooms in each class in the selected health facility,_
- Melihat ketersediaan kamar rumah sakit di setiap faskes yang memiliki kelas yang sama.
- _View the availability of hospital rooms in each health facility that has the same class._

## Teknologi (_Tech_)
Aplikasi berbasis web ini dibangun dengan menggunakan framework [Codeigniter 3](https://www.codeigniter.com/)
_This web-based application is built using the [Codeigniter 3](https://www.codeigniter.com/) framework_
- [Codeigniter 3](https://www.codeigniter.com/) - _PHP Framework_
- [Bootstrap](https://getbootstrap.com/) - _CSS Framework_
- [SB Admin 2](https://startbootstrap.com/theme/sb-admin-2) - _Web app admin theme_
- [Leaflet](https://leafletjs.com/) - _Javascript Map Library_
- [chriskacerguis/codeigniter-restserver](https://github.com/chriskacerguis/codeigniter-restserver) - _RESTful server implementation for CodeIgniter_

## LINK
| Aplikasi | Link |
| ------ | ------ |
| Backend | [http://m3118039.mhs.d3tiuns.com/v2](http://m3118039.mhs.d3tiuns.com/v2) |
| Frontend | [http://m3118039.mhs.d3tiuns.com/sikk-rs](http://m3118039.mhs.d3tiuns.com/sikk-rs) |

### Login Info
| Username | Password | Role |
| ------ | ------ | ------ |
| admin | adminuns | Admin |
| dinkes | dinkes | Admin |
| moewardi | moewardi | Pegawai |
| banyuanyar | banyuanyar | Pegawai |
