<!-- Main Content -->
<div id="content">

    <div class="container mb-3">
        <h1 class="display-6 text-center text-gray-800">Detail</h1>
        <h1 class="display-5 text-center text-gray-800"><?= $faskes['nama_faskes'] ?></h1>
    </div>

    <div class="card shadow mb-4 mx-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Fasilitas Kesehatan</h6>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <tr>
                    <th>Nama</th>
                    <td><?= $faskes['nama_faskes'] ?></td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td><?= $faskes['kategori_faskes'] ?></td>
                </tr>
                <tr>
                    <th>Tipe</th>
                    <td><?= $faskes['tipe_faskes'] ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><?= $faskes['alamat_faskes'] ?></td>
                </tr>
                <tr>
                    <th>Situs Web</th>
                    <td><a href="<?= $faskes['website_faskes'] ?>"><?= $faskes['website_faskes'] ?></a></td>
                </tr>
                <tr>
                    <th rowspan="2">Koordinat</th>
                    <td><?= $faskes['koordinat_faskes'] ?></td>
                </tr>
                <tr>
                    <td>
                        <div id="map"></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <a class="btn btn-sm btn-secondary mx-3" href="<?= base_url('admin/c_faskes') ?>">
        <i class="fas fa-fw fa-arrow-left"></i> Kembali
    </a>

</div>

<script type="text/javascript">
    let koordinat = "<?php echo($faskes['koordinat_faskes']) ?>";
    let latlong = koordinat.split(',');
    let latitude = latlong[0];
    let longitude = latlong[1];

    var map = L.map('map').setView([latitude, longitude], 16.5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([latitude, longitude]).addTo(map);
</script>
