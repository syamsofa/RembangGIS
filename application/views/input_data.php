
<div class="row">
    <main>



        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                List Kecamatan
            </div>
            <div class="card-body table-responsive">
                Tahun <select onchange="TampilData('')" id="pilihTahun" class="form-select" aria-label="Default select example">
                    <option value='' selected>--PILIH--</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                </select>
                Variabel <select onchange="TampilData('')" id="pilihVariabel" class="form-select" aria-label="Default select example">
                    <option value='' selected>--PILIH--</option>

                    <?php
                    foreach ($daftarVariabel as $key => $value) {

                        echo " <option value= " . $value['RecId'] . ">
                                " . $value['KodeVariabel'] . " - " . $value['NamaVariabel'] . " (" . $value['Sumber'] . ")
                                
                            </option>";
                    }

                    ?>
                </select>
                <button class="btn btn-success" onclick="TampilData('')">Get</button>
                <br>
                <table class="table table-hover table-striped table-sm" id="datatableKecamatan">
                    <thead class="thead-dark">
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Nilai Agregasi Desa</th>
                            <th>Nilai Non Agregat</th>
                            <th>Input Data Desa</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($daftarKecamatan as $key => $value) {
                            echo " <tr>
                                <td>" . $value['Kode'] . "</td>
                                <td>" . $value['Nama'] . "</td>
                                <td><input></td>
                                <td><input></td>
                                <td><input></td>
                            </tr>";
                        }

                        ?>

                    </tbody>
                </table>
            </div>


    </main>

</div>


<script>
    function TampilData() {
        datatableKecamatan = $('#datatableKecamatan').dataTable({
            "paging": false,
            "ordering": false,
            "info": false,
            "responsive": true,
            destroy: true,
            "lengthChange": false,
            "autoWidth": false,
            


        });
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/services/DataKecamatanByVariabelByTahun',
            dataType: 'json',
            data: {
                IdVariabel: $("#pilihVariabel").val(),
                Tahun: $("#pilihTahun").val()
            },
            success: function(output) {
                console.log(output);

                datatableKecamatan.fnClearTable();
                outputData = output.Data.DataKecamatan
                console.log(outputData);
                for (var i = 0; i < outputData.length; i++) {

                    outputDataBaris = outputData[i]

                    datatableKecamatan.fnAddData([
                        "" + outputDataBaris.Kode + "",
                        "" + outputDataBaris.Nama + "",
                        "<input align='right' readonly value='" + outputDataBaris.SumDesaByKecamatan + "'>",
                        "<input id='inputAgregat' onblur='ubahData(" + $("#pilihVariabel").val() + ",\"" + outputDataBaris.Kode + "\",\"" + $("#pilihTahun").val() + "\",this.value)' align='right' value='" + outputDataBaris.NonAgregat + "' type='number'>",
                        "<button type='button' onclick='isiDataDesa(" + outputDataBaris.Kode + "," + $("#pilihVariabel").val() + ",\"" + $("#pilihTahun").val() + "\")' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal'>Isi Data Desa</button>"
                    ]);
                } // End For

                $('#loaderGif').hide();
            },

            error: function(e) {
                console.log(e.responseText);
                setTimeout(() => {
                    $('#loaderGif').hide();
                }, 2000);

            }
        });

    }
</script>

<script>
    function ubahData(IdVariabel, KodeWilayah, Tahun, Nilai) {
        console.log(IdVariabel, KodeWilayah, Tahun, Nilai)
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/services/UbahData',
            dataType: 'json',
            data: {
                IdVariabel: IdVariabel,
                KodeWilayah: KodeWilayah,
                Tahun: Tahun,
                Nilai: Nilai
            },
            success: function(output) {
                console.log(output);

                datatableKecamatan.fnClearTable();
                outputData = output.Data.DataKecamatan
                console.log(outputData);
                for (var i = 0; i < outputData.length; i++) {

                    outputDataBaris = outputData[i]

                    datatableKecamatan.fnAddData([
                        "" + outputDataBaris.Kode + "",
                        "" + outputDataBaris.Nama + "",
                        "<input align='right' readonly value='" + outputDataBaris.SumDesaByKecamatan + "'>",
                        "<input id='inputAgregat' onblur='ubahData(" + $("#pilihVariabel").val() + ",\"" + outputDataBaris.Kode + "\",\"" + $("#pilihTahun").val() + "\"," + this.value + ")' align='right' value='" + outputDataBaris.NonAgregat + "' type='number'>"



                    ]);
                } // End For

                $('#loaderGif').hide();
            },

            error: function(e) {
                console.log(e.responseText);
                setTimeout(() => {
                    $('#loaderGif').hide();
                }, 2000);

            }
        });
    }
</script><!-- Button trigger modal -->

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
    function isiDataDesa(kodeKec, idVariabel, tahun) {


        datatableDesa = $('#datatableDesa').dataTable({
            "paging": false,
            "ordering": false,
            "info": false,
            "responsive": true,
            destroy: true,
            "lengthChange": false,
            "autoWidth": false,
            
        })
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/services/DataDesaByKecamatanByVariabelByTahun',
            dataType: 'json',
            data: {
                IdVariabel: idVariabel,
                KodeKecamatan: kodeKec,
                Tahun: tahun
            },
            success: function(output) {
                console.log(output);
                datatableDesa.fnClearTable();
                outputData = output.Data.DataDesa
                console.log(outputData);
                for (var i = 0; i < outputData.length; i++) {
                    outputDataBaris = outputData[i]
                    datatableDesa.fnAddData(
                        [
                            "" + outputDataBaris.Kode + "",
                            "" + outputDataBaris.Nama + "",
                            "<input id='' onblur='ubahDataDesa(" + $("#pilihVariabel").val() + ",\"" + outputDataBaris.Kode + "\",\"" + $("#pilihTahun").val() + "\" ,this.value)' align='right' value='" + outputDataBaris.SumDesa + "' type='number'>"

                        ]);
                } // End For

                $('#loaderGif').hide();
            },
            error: function(e) {

            }






        });
    }
</script>

<script>
    function ubahDataDesa(IdVariabel, KodeWilayah, Tahun, Nilai) {
        console.log(IdVariabel, KodeWilayah, Tahun, Nilai)
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo base_url(); ?>/services/UbahDataDesa',
            dataType: 'json',
            data: {
                IdVariabel: IdVariabel,
                KodeWilayah: KodeWilayah,
                Tahun: Tahun,
                Nilai: Nilai
            },
            success: function(output) {
                console.log(output);

                datatableKecamatan.fnClearTable();
                outputData = output.Data.DataKecamatan
                console.log(outputData);
                for (var i = 0; i < outputData.length; i++) {

                    outputDataBaris = outputData[i]

                    datatableKecamatan.fnAddData([
                        "" + outputDataBaris.Kode + "",
                        "" + outputDataBaris.Nama + "",
                        "<input align='right' readonly value='" + outputDataBaris.SumDesaByKecamatan + "'>",
                        "<input id='inputAgregat' onblur='ubahData(" + $("#pilihVariabel").val() + ",\"" + outputDataBaris.Kode + "\",\"" + $("#pilihTahun").val() + "\"," + this.value + ")' align='right' value='" + outputDataBaris.NonAgregat + "' type='number'>"



                    ]);
                } // End For

                $('#loaderGif').hide();
            },

            error: function(e) {
                console.log(e.responseText);
                setTimeout(() => {
                    $('#loaderGif').hide();
                }, 2000);

            }
        });
    }
</script>