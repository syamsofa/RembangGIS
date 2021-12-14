<div class="row">
    <main>
        <div class="container-fluid px-4">


            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    List Variabel
                    <button class="btn btn-success"><i class="fas fa-table me-1"></i> Tambah</button>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover table-striped table-sm" id="datatableVariabel">
                        <thead class="thead-dark">
                            <tr>
                                <th>Sumber</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Periode</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($daftarVariabel as $key => $value) {
                                echo " <tr>
                                <td>" . $value['Sumber'] . "</td>
                                <td>" . $value['KodeVariabel'] . "</td>
                                <td>" . $value['NamaVariabel'] . "</td>
                                <td>" . $value['Periode'] . "</td>
                            </tr>";
                            }

                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body  table-responsive">
                <table class="table table-hover table-striped table-sm" id="datatableDesa">
                    <thead class="thead-dark">
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Nilai Non Agregat</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

    });
</script>

<script>
    datatableVariabel = $('#datatableVariabel').dataTable({
        "responsive": true,
        destroy: true,

        "lengthChange": true,
        "autoWidth": false,
    });
</script>