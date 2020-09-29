<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Deni Arbianto &copy; <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>

<?= isset($footer_scripts) ?? null; ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        <?php if ($npage == "m_datastandar") : ?>
            $("#tblDataStandar").on("click", ".btn-edit", function() {
                // editDataStandarModal
                document.getElementById("mno_standar").value = $(this).data("no");
                document.getElementById("mtgl_standar").value = $(this).data("tglstandar");
                document.getElementById("mavailability").value = $(this).data("avail");
                document.getElementById("mperformance").value = $(this).data("performance");
                document.getElementById("mquality").value = $(this).data("quality");
                document.getElementById("moee").value = $(this).data("oee");
                $("#editDataStandarModal").modal('show');
            });
            $("#tblDataStandar").on("click", ".btn-delete", function() {
                // deleteDataStandarModal
                document.getElementById("dno_standar").value = $(this).data("no");
                document.getElementById("dtgl_standar").value = $(this).data("tglstandar");
                document.getElementById("davailability").value = $(this).data("avail");
                document.getElementById("dperformance").value = $(this).data("performance");
                document.getElementById("dquality").value = $(this).data("quality");
                document.getElementById("doee").value = $(this).data("oee");
                $("#deleteDataStandarModal").modal('show');
            });
        <?php elseif ($npage == "m_datauser") : ?>
            $("#tblDataUser").on("click", ".btn-edit", function() {
                // editDataUserModal
                document.getElementById("muser_id").value = $(this).data("userid");
                document.getElementById("mnama").value = $(this).data("nama");
                document.getElementById("musername").value = $(this).data("username");
                // document.getElementById("mpassword").value = $(this).data("pwd");
                document.getElementById("mdepartemen").value = $(this).data("departemen");
                $("#editDataUserModal").modal('show');
            });
            $("#tblDataUser").on("click", ".btn-delete", function() {
                // deleteDataUserModal
                document.getElementById("duser_id").value = $(this).data("userid");
                document.getElementById("dnama").value = $(this).data("nama");
                document.getElementById("dusername").value = $(this).data("username");
                document.getElementById("dpassword").value = $(this).data("pwd");
                document.getElementById("ddepartemen").value = $(this).data("departemen");
                $("#deleteDataUserModal").modal('show');
            });
        <?php elseif ($npage == "m_dataproduk") : ?>
            $("#tblDataProduk").on("click", ".btn-edit", function() {
                // editDataProdukModal
                document.getElementById("mno_produk").value = $(this).data("no");
                document.getElementById("mnama_produk").value = $(this).data("namaproduk");
                $("#editDataProdukModal").modal('show');
            });
            $("#tblDataProduk").on("click", ".btn-delete", function() {
                // deleteDataProdukModal
                document.getElementById("dno_produk").value = $(this).data("no");
                document.getElementById("dnama_produk").value = $(this).data("namaproduk");
                $("#deleteDataProdukModal").modal('show');
            });
        <?php elseif ($npage == "m_dataoee") : ?>
            $("#tblDataOee").on("click", ".btn-edit", function() {
                // editDataOeeModal
                document.getElementById("mid_oee").value = $(this).data("idoee");
                document.getElementById("mid_produksi").value = $(this).data("idproduksi");
                document.getElementById("mbreakdown").value = $(this).data("breakdown");
                document.getElementById("mtgl_oee").value = $(this).data("tgloee");
                document.getElementById("mjam_kerja").value = $(this).data("jamkerja");
                document.getElementById("msetup").value = $(this).data("setup");
                document.getElementById("mrun_time").value = $(this).data("runtime");
                var ideal_run_time = $(this).data("idealruntime");
                if (ideal_run_time == "4") {
                    document.getElementById("mideal_runtime4").checked = true;
                } else if (ideal_run_time == "5") {
                    document.getElementById("mideal_runtime5").checked = true;
                } else if (ideal_run_time == "6") {
                    document.getElementById("mideal_runtime6").checked = true;
                }
                document.getElementById("mbad_count").value = $(this).data("badcount");
                document.getElementById("mgood_count").value = $(this).data("goodcount");
                document.getElementById("mtotal_count").value = $(this).data("totalcount");
                $("#editDataOeeModal").modal('show');
            });
            $("#tblDataOee").on("click", ".btn-delete", function() {
                // deleteDataOeeModal
                document.getElementById("did_oee").value = $(this).data("idoee");
                document.getElementById("did_produksi").value = $(this).data("idproduksi");
                document.getElementById("dbreakdown").value = $(this).data("breakdown");
                document.getElementById("dtgl_oee").value = $(this).data("tgloee");
                document.getElementById("djam_kerja").value = $(this).data("jamkerja");
                document.getElementById("dsetup").value = $(this).data("setup");
                document.getElementById("drun_time").value = $(this).data("runtime");
                var ideal_run_time = $(this).data("idealruntime");
                if (ideal_run_time == "4") {
                    document.getElementById("dideal_runtime4").checked = true;
                } else if (ideal_run_time == "5") {
                    document.getElementById("dideal_runtime5").checked = true;
                } else if (ideal_run_time == "6") {
                    document.getElementById("dideal_runtime6").checked = true;
                }
                document.getElementById("dideal_runtime").value = ideal_run_time;
                document.getElementById("dbad_count").value = $(this).data("badcount");
                document.getElementById("dgood_count").value = $(this).data("goodcount");
                document.getElementById("dtotal_count").value = $(this).data("totalcount");
                $("#deleteDataOeeModal").modal('show');
            });
        <?php elseif ($npage == "inputproduksi") : ?>
            $("#tblProduksi").on("click", ".btn-edit", function() {
                // editInputProduksiModal
                //document.getElementById("mid_produksi").value = $(this).data("idproduksi");
                document.getElementById("mnm_produk").value = $(this).data("noproduk");
                document.getElementById("mtgl_produksi").value = $(this).data("tglproduksi");
                $("#editInputProduksiModal").modal('show');
            });
            $("#tblProduksi").on("click", ".btn-delete", function() {
                // deleteInputProduksiModal
                document.getElementById("did_produksi").value = $(this).data("idproduksi");
                document.getElementById("dnm_produk").value = $(this).data("noproduk");
                document.getElementById("dtgl_produksi").value = $(this).data("tglproduksi");
                $("#deleteInputProduksiModal").modal('show');
            });

        <?php endif; ?>
    });
    <?php if ($npage == "m_dataoee") : ?>

        function runtime() {
            let jam_kerja = document.getElementById("jam_kerja").value || 0;
            let breakdown = document.getElementById("breakdown").value || 0;
            let setup = document.getElementById("setup").value || 0;
            let runtime = parseInt(jam_kerja) - (parseInt(breakdown) + parseInt(setup));
            document.getElementById("run_time").value = runtime;
        }

        function edit_runtime() {
            let jam_kerja = document.getElementById("mjam_kerja").value || 0;
            let breakdown = document.getElementById("mbreakdown").value || 0;
            let setup = document.getElementById("msetup").value || 0;
            let runtime = parseInt(jam_kerja) - (parseInt(breakdown) + parseInt(setup));
            document.getElementById("mrun_time").value = runtime;
        }

        function totalcount() {
            let bad_count = document.getElementById("bad_count").value || 0;
            let good_count = document.getElementById("good_count").value || 0;
            let total_count = parseInt(bad_count) + parseInt(good_count);
            document.getElementById("total_count").value = total_count;
        }

        function edit_totalcount() {
            let bad_count = document.getElementById("mbad_count").value || 0;
            let good_count = document.getElementById("mgood_count").value || 0;
            let total_count = parseInt(bad_count) + parseInt(good_count);
            document.getElementById("mtotal_count").value = total_count;
        }
    <?php endif; ?>
</script>

<?php if ($npage == 'grafikoee') : ?>
    <script src="<?= base_url('assets/vendor/chart.js/Chart.bundle.min.js'); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            drawChart();
            $("#btn_display").click(function() {
                drawChart();
            });
        });

        function drawChart() {
            var label_init = "";
            var oee_init = "";
            // biar gak double, hapus ketika ganti
            if (window.myChart != null) {
                window.myChart.destroy();
            }
            // ambil tgl awal & akhir
            var awal = document.getElementById("tgl_awal").value;
            var akhir = document.getElementById("tgl_akhir").value;

            var url = "<?= base_url('menu/ajax_grafik_oee/param1/param2') ?>";
            url = url.replace('param1', awal);
            url = url.replace('param2', akhir);
            
            $.ajax({
                url: url,
                type: 'GET',
                async: false,
                success: function (data) {
                    data = JSON.parse(data);
                    label_init = data.label;
                    oee_init = data.oee;
                },
                error: function (data) {
                    alert("Error!");
                }
            });
            // draw chart
            console.log(label_init);
            console.log(oee_init);

            var config = {
                type: 'line',
                data: {
                    labels: label_init,
                    datasets: [{
                        label: ['OEE'],
                        data: oee_init,
                        fill: false,
                        borderColor: '#ff0000',
                        borderWidth: 1,
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero: false
                            }
                        }],
                        yAxes: [{
                            stacked: true,
                            ticks: {
                                stepSize: 5,
                                beginAtZero: false,
                                suggestedMin: 0,
                                suggestedMax: 100
                            }
                        }]
                    }
                }
            }
            var cnv = document.getElementById('chart1');
            cnv.width  = 400;
            cnv.height = 300; 
            cnv.style.width  = '800px';
            cnv.style.height = '600px';
            var ctx = cnv.getContext('2d');
            window.myChart = new Chart(ctx, config);
            // end of draw
        }
    </script>
<?php endif; ?>

</body>

</html>