

$(document).ready(function () {
    var basepath = $("#basepath").val();
    loadPartialView("#tab_one", basepath + "investor/corporate_governance_partial_view");
    $("#tab_one-tab").on("click", function(event) {
        event.preventDefault();
        loadPartialView("#tab_one", basepath + "investor/corporate_governance_partial_view");
    });
    $("#tab_two-tab").on("click", function(event) {
        event.preventDefault();
        loadPartialView("#tab_two", basepath + "investor/shareholders_information_partial_view");
    });
    $("#tab_three-tab").on("click", function(event) {
        event.preventDefault();
        loadPartialView("#tab_three", basepath + "investor/financials_partial_view");
    });
    $("#tab_four-tab").on("click", function(event) {
        event.preventDefault();
        loadPartialView("#tab_four", basepath + "investor/financials_partial_notice");
    });
    $(".update_btn").on("click", function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        var title = $(this).data('title');
        var videoid = $(this).data('videoid');
        $("#videoId").val(id);
        $("#mode").val("EDIT");
        $("#title").val(title);
        $("#link").val(videoid);
        $("#save_btn").html("Update");
    });


    
}); // end of document ready
function loadPartialView(tabId, partialViewUrl) {

    
    $("#tab_one_data,#tab_two_data,#tab_three_data,#tab_four_data").html("");
    $.ajax({
        url: partialViewUrl,
        type: 'GET',
        success: function(data) {
            $(tabId + "_data").html(data);
            $('.dataTable').DataTable({ paging: false });
        },
        error: function(xhr, status, error) {
            console.error("Error loading partial view:", error);
        }
    });
}