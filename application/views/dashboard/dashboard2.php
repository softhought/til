<script>
    var Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
    });
    <?php if (isset($_SESSION["isUserAllowed"])) { ?>
        Toast.fire({
            type: "error",
            title: "You are not authorized to access this URL.",
        });

        setTimeout(function () {
            $.ajax({
                type: 'GET',
                url: 'unset_session',
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status) {
                        console.log("Session variable unset."); 
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error unsetting session variable:", error);
                }
            });
        }, 1000);
    <?php } ?>
</script>

<div style="text-align: center;">
    <h2>Welcome to Dashboard</h2>
</div>