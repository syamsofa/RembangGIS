
<div class="row">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Login</h3>
                </div>
                <div class="card-body">
                    <form id="formLogin">
                        <div class="form-floating mb-3">
                            <input id="username" name="username" class="form-control" id="inputEmail" type="text" placeholder="name@example.com">
                            <label for="inputEmail">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input id="password" name="password" class="form-control" id="inputPassword" type="password" placeholder="Password">
                            <label for="inputPassword">Password</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#formLogin").submit(function(event) {
        $.ajax({
            type: "POST",
            cache: false,
            url: '<?php echo base_url(); ?>/servicespengguna/LoginJatengklik',
            dataType: 'json',
            data: {
                username: $("#username").val(),
                password: $("#password").val()
            },
            success: function(output) {
                // $("#buttonSubmit").html(" Login ");

                console.log(output)
                if (output.sukses == true)
                    location.reload();


            }

        })
        event.preventDefault()




    });
</script>