<div class="row">
    <main>
        <div class="container-fluid px-4">

           
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    List Variabel
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover table-striped table-sm" id="datatableVariabel">
                    <thead class="thead-dark">
                            <tr>
                                <th>Sumber</th>
                                <th>Kode</th>
                                <th>Nama</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($daftarVariabel as $key => $value) {
                                echo " <tr>
                                <td>".$value['Sumber']."</td>
                                <td>".$value['KodeVariabel']."</td>
                                <td>".$value['NamaVariabel']."</td>
                                
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