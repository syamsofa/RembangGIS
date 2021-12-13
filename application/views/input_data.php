<style>
    table.dataTable td {
        font-size: 0.9em;
    }
</style>

<div class="row">
    <main>



        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                List Kecamatan
            </div>
            <div class="card-body table-responsive">
                Tahun <select id="pilihTahun" class="form-select" aria-label="Default select example">
                    <option selected>--PILIH--</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                </select>
                Variabel <select id="pilihVariabel" class="form-select" aria-label="Default select example">
                    <option selected>--PILIH--</option>

                    <?php
                    foreach ($daftarVariabel as $key => $value) {

                        echo " <option value= " . $value['RecId'] . ">
                                " . $value['KodeVariabel'] . " - " . $value['NamaVariabel'] . " (" . $value['Sumber'] . ")
                                
                            </option>";
                    }

                    ?>
                </select>
                <button class="btn btn-success" onclick="TampilData('ij')">Get</button>
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
    datatableKecamatan = $('#datatableKecamatan').dataTable({
        "paging": false,
        "ordering": false,
        "info": false


    });
</script>

<script>
    function TampilData() {

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
                        "<button onclick='isiDataDesa()'><i class='fas fa-bars'></i></button>"
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
</script>