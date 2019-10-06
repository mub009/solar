<select class="mt-multiselectsubcategory btn btn-default" multiple="multiple" data-label="left" data-width="100%"
    data-filter="true" data-action-onchange="true">

    <?php

if (!empty($ajax)) {
    foreach ($ajax as $row) {
        if (!empty($row['SubCategoryId'])) {
            ?>

    <option value='<?=$row['SubCategoryId']?>'>
        <?=$row['SubcategoryName']?>
    </option>

    <?php
}
    }

}

?>
</select>

<script>
    var subcategory = $.makeArray();


    var ComponentsBootstrapMultiselect2 = function () {
        return {
            init: function () {
                $(".mt-multiselectsubcategory").each(function () {
                    var t, a = $(this).attr("class"),
                        i = !!$(this).data("clickable-groups") && $(this).data("clickable-groups"),
                        l = !!$(this).data("collapse-groups") && $(this).data("collapse-groups"),
                        o = !!$(this).data("drop-right") && $(this).data("drop-right"),
                        e = (!!$(this).data("drop-up") && $(this).data("drop-up"), !!$(this).data(
                            "select-all") && $(this).data("select-all")),
                        s = $(this).data("width") ? $(this).data("width") : "",
                        n = $(this).data("height") ? $(this).data("height") : "",
                        d = !!$(this).data("filter") && $(this).data("filter"),
                        h = function (t, a, i) {



                            if (-1 != subcategory.indexOf($(t).val())) {

                                subcategory = $.grep(subcategory, function (value) {

                                    return value != $(t).val();

                                });






                            } else {


                                subcategory.push($(t).val());

                            }


                            $.ajax({
                                type: "POST",
                                async: false,
                                url: "<?=base_url()?>backend/admin/manage_product/producttemplate/producttemplate/ajax_product_list",
                                data: 'subcategory_id=' + subcategory,
                                success: function (data) {



                                    $("#producttable").remove();

                                    $("#newproducttable").html(data);



                                }
                            });






                        },
                        r = function (t) {
                            alert("Dropdown shown.")
                        },
                        c = function (t) {
                            alert("Dropdown Hidden.")
                        },
                        p = 1 == $(this).data("action-onchange") ? h : "",
                        u = 1 == $(this).data("action-dropdownshow") ? r : "",
                        b = 1 == $(this).data("action-dropdownhide") ? c : "";
                    t = $(this).attr("multiple") ?
                        '<li class="mt-checkbox-list"><a href="javascript:void(0);"><label class="mt-checkbox"> <span></span></label></a></li>' :
                        '<li><a href="javascript:void(0);"><label></label></a></li>', $(this).multiselect({
                            enableClickableOptGroups: i,
                            enableCollapsibleOptGroups: l,
                            disableIfEmpty: !0,
                            enableFiltering: d,
                            includeSelectAllOption: e,
                            dropRight: o,
                            buttonWidth: s,
                            maxHeight: n,
                            onChange: p,
                            onDropdownShow: u,
                            onDropdownHide: b,
                            buttonClass: a
                        })
                })
            }
        }
    }();
    jQuery(document).ready(function () {
        ComponentsBootstrapMultiselect2.init()
    });
</script>