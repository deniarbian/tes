<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Grafik OEE Produksi AMMDes</h1>


        <div class="row">
            <div class="col-lg">
                <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors(); ?>
                    </div>
                <?php endif; ?>

                <?= $this->session->flashdata('message'); ?>
                <div class="row form-group">
                    <label>Pilih Standar</label>
                    <select name="no_standar" id="no_standar" class="form-control">
                    <option value="">Select Standar </option>
                    <?php foreach ($dataStandar as $ds) : ?>
                        <option value="<?= $ds['no_standar']; ?>" > Standar <?= $ds['no_standar']; ?> --> OEE: <?= $ds['oee']; ?><?</option>
                    <?php endforeach; ?>
                </select>
                    <div class="col-md-4">
                        <label>Tanggal Awal</label>
                        <input type="date" name="awal" id="tgl_awal" class="form-control" value="<?= date('Y-m-d', strtotime('-3 days')) ?>">
                    </div>
                    <div class="col-md-4">
                        <label>Tanggal Akhir</label>
                        <input type="date" name="akhir" id="tgl_akhir" class="form-control" value="<?= date('Y-m-d') ?>">
                    </div>
                    <div class="col-md-2">
                        <label>Aksi</label>
                        <button id="btn_display" class="btn btn-primary form-control">Display</button>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <canvas id="chart1" style="width: 100%" height="500px"></canvas>
                    </div>
                </div>

            </div>
        </div>