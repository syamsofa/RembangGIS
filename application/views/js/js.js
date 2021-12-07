function getDataKecamatanByVariabel(baseUrl, idVariabel) {
    // alert(idVariabel)
    $.ajax({
        type: "POST",
        async: false,
        url: baseUrl + 'services/DataKecamatanByVariabel',
        dataType: 'json',
        data: {
            IdVariabel: idVariabel
        },
        success: function (output) {
            console.log(output.Data.Variabel)
            console.log(output.Data.NilaiMinimal, output.Data.NilaiMaksimal)
            var jumlahKelas = 6
            var rentangKelas = (output.Data.NilaiMaksimal - output.Data.NilaiMinimal) / jumlahKelas
            console.log('rentangklas', rentangKelas)

            var grades = []
            for (g = 0; g < jumlahKelas; g++) {

                grades.push(Math.ceil(rentangKelas))

            }
            console.log(grades)
            console.log(output.Data.DataKecamatan)
            var iter = 0
            Kecamatan.features.forEach(element => {
                element.properties.nilai = output.Data.DataKecamatan[iter].SumDesaByKecamatan
                iter++
            });


        }
    })

}