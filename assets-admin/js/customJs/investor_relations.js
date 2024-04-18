

$(document).ready(function () {
    var basepath = $("#basepath").val();
  
    loadPartialView("#tab_one", basepath + "investor/corporate_governance_partial_view");

    $(document).on('click', "#tab_one-tab", function(e) {    
        e.preventDefault();
        $("#relations_master_id").val(1);
        $("#investor_relation_head").val("Corporate Governance");
        loadPartialView("#tab_one", basepath + "investor/corporate_governance_partial_view");
    });

    
    $(document).on('click', "#tab_two-tab", function(e) {      
        e.preventDefault();
        $("#relations_master_id").val(2);
        $("#investor_relation_head").val("Shareholders Information");
        loadPartialView("#tab_two", basepath + "investor/shareholders_information_partial_view");
    });

    $(document).on('click', "#tab_three-tab", function(e) {    
        e.preventDefault();
        $("#relations_master_id").val(3);
        $("#investor_relation_head").val("Financials");
        loadPartialView("#tab_three", basepath + "investor/financials_partial_view");
    });

    $(document).on('click', "#tab_four-tab", function(e) {   
        e.preventDefault();
        $("#relations_master_id").val(4);
        $("#investor_relation_head").val("Notice");
        loadPartialView("#tab_four", basepath + "investor/notice_partial_view");
    });


    $(document).on('click', ".showaddbtn", function(e) {   
        e.preventDefault();
        let mode="ADD";
        let relations_master_id=$("#relations_master_id").val();
        let relations_dtl_id=0;
        loadAddEditView(basepath,mode,relations_master_id,relations_dtl_id);     
        $(".frm_header").html($("#investor_relation_head").val());

    });

   
    
}); // end of document ready

function loadAddEditView(basepath,mode,relations_master_id,relations_dtl_id){
    
    $("#add_edit_view_data").html("Loading....");
    $.ajax({
        url: basepath + "investor/add_edit_investor_relations_partial_view",
        type: 'POST',
        data: {mode:mode,relations_master_id:relations_master_id,relations_dtl_id:relations_dtl_id},
        success: function(data) {
            $("#add_edit_view_data").html(data);
          
        },
        error: function(xhr, status, error) {
            console.error("Error loading partial view:", error);
        }
    });
}
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