<style>

    /* Styles for the drop-down. Feel free to change the styles to suit your website. :-) */

.cb-dropdown-wrap {
  max-height: 80px; /* At most, around 3/4 visible items. */
  position: relative;
  height: 19px;
}

.cb-dropdown,
.cb-dropdown li {
  margin: 0;
  padding: 0;
  list-style: none;
}

.notes {
    margin-inline-end: 350px;
}
.cb-dropdown {
  position: absolute;
  z-index: 1;
  width: 100%;
  height: 100%;
  overflow: hidden;
  background: #fff;
  border: 1px solid #888;
}

/* For selected filter. */
.active .cb-dropdown {
  background: pink;
}

.cb-dropdown-wrap:hover .cb-dropdown {
  height: 80px;
  overflow: auto;
  transition: 0.2s height ease-in-out;
}

/* For selected items. */
.cb-dropdown li.active {
  background: #ff0;
}

.cb-dropdown li label {
  display: block;
  position: relative;
  cursor: pointer;
  line-height: 19px; /* Match height of .cb-dropdown-wrap */
}

.cb-dropdown li label > input {
  position: absolute;
  right: 0;
  top: 0;
  width: 16px;
}

.cb-dropdown li label > span {
  display: block;
  margin-left: 3px;
  margin-right: 20px; /* At least, width of the checkbox. */
  font-family: sans-serif;
  font-size: 0.8em;
  font-weight: normal;
  text-align: left;
}

/* This fixes the vertical aligning of the sorting icon. */
table.dataTable thead .sorting,
table.dataTable thead .sorting_asc,
table.dataTable thead .sorting_desc,
table.dataTable thead .sorting_asc_disabled,
table.dataTable thead .sorting_desc_disabled {
  background-position: 100% 10px;
}
</style>






<div class="modal fade" id="delete" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Subcategory Delete</h4>
            </div>


            <form action="<?=base_url() . 'backend/admin/manage_data/subcategory/subcategory/delete'?>" method="post">

                <input type="hidden" class="form-control" id="delete_Subcategory_id" name="delete_Subcategory_id"
                    autocomplete="off">


                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn green" name='delete' value="Delete">
                </div>
            </form>

        </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>





<div class="modal fade" id="basi" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">



            <div class="modal-body">




                <div class="portlet light form-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-dribbble font-green"></i>
                            <span class="caption-subject font-green bold uppercase">Add Subcategory</span>
                        </div>
                        <div class="actions">

                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->

                        <form action="<?=base_url() . 'backend/admin/manage_data/subcategory/subcategory/insert'?>" id="InsertForm"
                            class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="form-group" id="validation_category_id_insert">
                                    <label class="control-label col-md-5" style=" text-align:left;">Category <span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-7 ">
                                        <select class="form-control" name="category_id">
                                            <option value="">Select Category</option>

                                            <?php

foreach ($category as $row) {
    ?>
                                            <option value="<?=$row['CategoryId']?>">
                                                <?=$row['CategoryName']?>
                                            </option>
                                            <?php
}
?>
                                        </select>

                                    </div>
                                </div>




                                <div class="form-group" id="validation_Subcategory_number_insert">
                                    <label class="control-label col-md-5" style=" text-align:left;">SubCategory Name <span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-7">

                                        <input type="text" class="form-control" id="Subcategory_number" name="Subcategory_number"
                                            placeholder="Enter Subcategory Name" autocomplete="off">


                                    </div>
                                </div>




                                <div class="form-group" id="validation_image_insert">
                                    <div class="col-md-12">


                                        <center>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;"></div>
                                                <div>
                                                    <span class="btn red btn-outline btn-file">
                                                        <span class="fileinput-new"> Select image </span>
                                                        <span class="fileinput-exists"> Change </span>
                                                        <input type="hidden" value="" name="..."><input type="file"
                                                            name="image" accept="image/*"> </span>
                                                    <a href="javascript:;" class="btn red fileinput-exists"
                                                        data-dismiss="fileinput"> Remove </a>
                                                        <br><br>
                                            <div class="alert alert-success">
                                            <strong>For Perfect Size 100kb, Width:200px and Height:150px</strong>. </div>
                                                </div>
                                            </div>

                                        </center>

                                    </div>
                                </div>





                            </div>








                            <!-- END FORM-->
                    </div>
                </div>





            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                <input type="submit" class="btn green" name='submit' id="insert" value="Save changes">
            </div>
            </form>

        </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>









<div class="modal fade" id="edit" tabindex="-1" role="editModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">










                <div class="portlet light form-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-dribbble font-green"></i>
                            <span class="caption-subject font-green bold uppercase">Update Subcategory</span>
                        </div>
                        <div class="actions">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="<?=base_url() . 'backend/admin/manage_data/subcategory/subcategory/update'?>"
                            method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
                            <div class="form-body">
                                <div class="form-group" id="validation_category_id_update">
                                    <label class="control-label col-md-5" style=" text-align:left;">Category</label>
                                    <div class="col-md-7 ">

                                        <select class="form-control" name="category_id" id="edit_category_id">
                                            <option value="">Select Category</option>

                                            <?php
foreach ($category as $row) {
    ?>
                                            <option value="<?=$row['CategoryId']?>">
                                                <?=$row['CategoryName']?>
                                            </option>

                                            <?php
}
?>

                                        </select>




                                    </div>
                                </div>



                                <div class="form-group" id="validation_Subcategory_number_update">
                                    <label class="control-label col-md-5" style=" text-align:left;">SubCategory Name</label>
                                    <div class="col-md-7">

                                        <input type="text" class="form-control" id="edit_Subcategory_number" name="Subcategory_number"
                                            placeholder="Enter Subcategory Number" autocomplete="off">

                                    </div>
                                </div>



                                <div class="form-group" id="validation_Subcategory_status_update">
                                    <label class="control-label col-md-5" style=" text-align:left;">Status</label>
                                    <div class="col-md-7">

                                        <select name='Subcategory_status' id="editStatusList" class="form-control">

                                            <?php

foreach ($status as $row) {
    ?>
                                            <option value="<?=$row['Id']?>">
                                                <?=$row['Name']?>
                                            </option>
                                            <?php
}

?>
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group" id="validation_image_update">

                                    <div class="col-md-5">

                                        <center>
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;"><img
                                                    src="" id="edit_image" alt="image"></div>
                                            <span class="btn red btn-outline btn-file">
                                                <span class="fileinput-new"> Preview </span>

                                    </div>
                                    <div class="col-md-7">


                                        <center>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;"></div>
                                                <div>
                                                    <span class="btn red btn-outline btn-file">
                                                        <span class="fileinput-new"> Select image </span>
                                                        <span class="fileinput-exists"> Change </span>
                                                        <input type="hidden" value="" name="..."><input type="file"
                                                            name="image" accept="image/*"> </span>
                                                    <a href="javascript:;" class="btn red fileinput-exists"
                                                        data-dismiss="fileinput"> Remove </a>
                                                        <br><br>
                                            <div class="alert alert-success">
                                            <strong>For Perfect Size 100kb, Width:200px and Height:150px</strong>. </div>                                            </div>
                                            </div>

                                        </center>

                                    </div>
                                </div>





                            </div>








                            <!-- END FORM-->
                    </div>
                </div>










            </div>




            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                <input type="hidden" class="form-control" name="id" id="edit_Subcategory_id">

                <input type="submit" class="btn green" name='update' value="Save changes">
            </div>
            </form>

        </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>









<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">
                        <?=$title?></span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided" data-toggle="buttons">

                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">

                    <div class="row">
                        <div class="col-md-6">
                        <?php
if ($AdminPrivilege or in_array('SubCategoryAdd', $this->data['CountryPrivilege'])) {
    ?>
                            <div class="btn-group">


                                <a id="sample_editable_1_new" class="btn blue-hoki" data-target="#basi" data-toggle="modal">
                                    Add &nbsp<i class="fa fa-plus"></i></a>


                            </div>
                            <?php
}
?>
                        </div>

                        <div class="col-md-6">
                            <div class="btn-group pull-right">
                                <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-print"></i> Print </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>



                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_11">
                    <thead>
                        <tr>
                            <th>
                                SlNo
                            </th>
                            <th> category </th>
                            <th> Subcategory </th>
                            <th> Image </th>
                            <th> Status </th>
                           
                            <?php
if ($AdminPrivilege or in_array('SubCategoryEdit', $this->data['CountryPrivilege']) || in_array('SubCategoryDelete', $this->data['CountryPrivilege'])) {
    ?>
                            <th> Actions </th>
                            <th> View </th>
                            <?php
                            }
                            ?>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

if (!empty($Subcategory_details)) {
    $count = 1;
    foreach ($Subcategory_details as $row) {

        ?>

                        <tr class="odd gradeX">
                            <td>
                                <?=$count?>
                            </td>

                            <td>
                                <?=$row['CategoryName']?>
                            </td>
                            <td>
                                <?=$row['SubcategoryName']?>
                            </td>
                            <td>
                                <?php if (!empty($row['ImagePath'])) {?> <img src="<?=($config_update['is_FileManager'])?$config_update['ImageLocation']:base_url($config_update['ImageLocation'])?><?='50x50/'.$row['ImagePath']?>"
                                    alt="image" height="50" width="80">
                                <?php }?>
                            </td>
                            <td>

                                <?php
if ($row['StatusId'] == 1) {

            ?>

                                <span class="label label-sm btn green-jungle"> Active </span>
                                <?php
} elseif ($row['StatusId'] == 4) {

            ?>

                                <span class="label label-sm btn purple-soft"> Blocked </span>

                                <?php
}

        ?>
                            </td>
                            <?php
if ($AdminPrivilege or in_array('SubCategoryEdit', $this->data['CountryPrivilege']) || in_array('SubCategoryDelete', $this->data['CountryPrivilege'])) {
    ?>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-xs label-danger dropdown-toggle" type="button" data-toggle="dropdown"
                                        aria-expanded="false">
                                        Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-left" role="menu">
                                    <?php
if ($AdminPrivilege or in_array('SubCategoryEdit', $this->data['CountryPrivilege'])) {
                ?>
                                        <li>
                                            <a href="#" onclick='editFunc("<?=$row['Id']?>")' data-toggle="modal"
                                                data-target="#edit">
                                                <i class="icon-docs"></i> Edit </a>
                                        </li>
                                        <?php
}
 if ($AdminPrivilege or in_array('SubCategoryDelete', $this->data['CountryPrivilege'])) {
                ?>
                                        <li>


                                            <a href="#" onclick='deleteFunc("<?=$row['Id']?>")' data-toggle="modal"
                                                data-target="#delete">
                                                <i class="icon-docs"></i> delete </a>

                                        </li>
                                        <td align="center">


<a href="<?=base_url() . 'backend/admin/manage_data/subcategory/modal/view/' . $row['Id']?> "  data-toggle="modal" data-target="#basic">
    <i class="icon-eye"></i></a>

</td>
<?php
 }
 ?>
                                    </ul>
                                </div>
                            </td>
                            <?php
}
?>
                        </tr>
                        <?php
$count++;
    }
}
?>


                    </tbody>
                </table>

                <?=$legancy?>

                <script>
                    $('#NavMainManageData').addClass('open active');

                    $('#ArrowMainManageData').addClass('open active');

                    $('#NavManageDataSubCategory').addClass('open active');



                    $('#InsertForm').submit(function (e) {
                        e.preventDefault();
                        var flag;
                        var me = $(this);
if (me.data('requestRunning')) {
    alert('Please Wait Your request is processing');
    return;
}
me.data('requestRunning', true);

                        $.ajax({
                            type: "POST",
                            url: '<?=base_url()?>' +
                                'backend/admin/manage_data/subcategory/subcategory/insert',
                            enctype: 'multipart/form-data',
                            data: new FormData(this),
                            processData: false,
                            contentType: false,
                            cache: false,
                            async: false,
                            success: function (response) {

                                //console.log(response);
                                flag=false;
                                location.reload();


                            },
                            error: function (jqXhr) {


                                var json = $.parseJSON(jqXhr.responseText);

                                flag=true;
                      me.data('requestRunning', false);

                                if (typeof json.image != 'undefined') {


                                    $("#validation_image_insert").addClass("has-error");

                                    $('#error_image_insert').remove();

                                    $('#validation_image_insert .col-md-12').append(
                                        "<span class='help-block' id='error_image_insert'><center>" +
                                        json.image + "</center></span>");
                                } else {
                                    $("#validation_image_insert").removeClass("has-error");

                                    $('#verror_image_insert').remove();

                                    $("#validation_image_insert").addClass("has-success");


                                }


                                if (typeof json.Subcategory_number != 'undefined') {

                                    $("#validation_Subcategory_number_insert").addClass("has-error");

                                    $('#error_Subcategory_number_insert').remove();

                                    $('#validation_Subcategory_number_insert .col-md-7').append(
                                        "<span class='help-block' id='error_Subcategory_number_insert'>" +
                                        json.Subcategory_number + "</span>");
                                } else {
                                    $("#validation_Subcategory_number_insert").removeClass(
                                        "has-error");

                                    $('#error_Subcategory_number_insert').remove();

                                    $("#validation_Subcategory_number_insert").addClass(
                                        "has-success");


                                }
                                if (typeof json.category_id != 'undefined') {

                                    $("#validation_category_id_insert").addClass("has-error");

                                    $('#error_category_id_insert').remove();

                                    $('#validation_category_id_insert .col-md-7').append(
                                        "<span class='help-block' id='error_category_id_insert'>" +
                                        json.category_id + "</span>");


                                } else {
                                    $("#validation_category_id_insert").removeClass("has-error");

                                    $('#error_category_id_insert').remove();

                                    $("#validation_category_id_insert").addClass("has-success");


                                }

                            }
                            ,
             complete: function() {

if(flag)
{
    me.data('requestRunning', false);
}
else
{
    me.data('requestRunning', true);
}


     }

                        });

                    });

                    $('#UpdateForm').submit(function (e) {
                        e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: '<?=base_url()?>' +
                                'backend/admin/manage_data/subcategory/subcategory/update',
                            enctype: 'multipart/form-data',
                            data: new FormData(this),
                            processData: false,
                            contentType: false,
                            cache: false,
                            async: false,
                            success: function (response) {

                                // console.log(response);

                                location.reload();


                            },
                            error: function (jqXhr) {


                                var json = $.parseJSON(jqXhr.responseText);

                                console.log(json);	flag=true;
                      me.data('requestRunning', false);






                                if (typeof json.image != 'undefined') {


                                    $("#validation_image_update").addClass("has-error");

                                    $('#error_image_update').remove();

                                    $('#validation_image_update .col-md-12').append(
                                        "<span class='help-block' id='error_image_update'><center>" +
                                        json.image + "</center></span>");
                                } else {
                                    $("#validation_image_update").removeClass("has-error");

                                    $('#verror_image_update').remove();

                                    $("#validation_image_update").addClass("has-success");


                                }




                                if (typeof json.Subcategory_number != 'undefined') {

                                    $("#validation_Subcategory_number_update").addClass("has-error");

                                    $('#error_Subcategory_number_update').remove();

                                    $('#validation_Subcategory_number_update .col-md-7').append(
                                        "<span class='help-block' id='error_Subcategory_number_update'>" +
                                        json.Subcategory_number + "</span>");
                                } else {
                                    $("#validation_Subcategory_number_update").removeClass(
                                        "has-error");

                                    $('#error_Subcategory_number_update').remove();

                                    $("#validation_Subcategory_number_update").addClass(
                                        "has-success");


                                }


                                if (typeof json.Subcategory_status == 'undefined') {

                                    $("#validation_Subcategory_status_update").addClass("has-error");

                                    $('#error_Subcategory_status_update').remove();

                                    $('#validation_Subcategory_status_update .col-md-7').append(
                                        "<span class='help-block' id='error_Subcategory_status_update'>" +
                                        json.Subcategory_status + "</span>");
                                } else {
                                    $("#validation_Subcategory_status_update").removeClass(
                                        "has-error");

                                    $('#error_Subcategory_status_update').remove();

                                    $("#validation_Subcategory_status_update").addClass(
                                        "has-success");


                                }



                                if (typeof json.category_id != 'undefined') {

                                    $("#validation_category_id_update").addClass("has-error");

                                    $('#error_category_id_update').remove();

                                    $('#validation_category_id_update .col-md-7').append(
                                        "<span class='help-block' id='error_category_id_update'>" +
                                        json.category_id + "</span>");
                                } else {
                                    $("#validation_category_id_update").removeClass("has-error");

                                    $('#error_category_id_update').remove();

                                    $("#validation_category_id_update").addClass("has-success");


                                }
                            }


                        });

                    });


                    function editFunc(id) {

                        var base_url = "<?=base_url()?>";

                        $.ajax({
                            url: base_url + 'backend/admin/manage_data/subcategory/subcategory/details/' + id,
                            dataType: 'json',
                            async: false,
                            success: function (response) {

                                // //alert(response[0].txt_users_username);

                                console.log(response);

                                var url = "<?=base_url()?>";

                                // //alert(url+response[0].ImagePath);

                                $('#edit_image').attr('src', "<?=($config_update['is_FileManager'])?$config_update['ImageLocation']:base_url($config_update['ImageLocation'])?>" +'100x50/' + response[0].ImagePath);

                                $("#edit_category_id").val(response[0].CategoryId);


                                $("#edit_Subcategory_number").val(response[0].SubcategoryName);

                                $("#edit_Subcategory_code").val(response[0].SubcategoryCode);


                                $("#edit_Subcategory_id").val(response[0].Id);



                                $("#edit_delete_image").val(response[0].ImagePath);



                                // //edit_Subcategory_id

                                $("#editStatusList").children('[value="' + response[0].StatusId + '"]').attr(
                                    'selected', true);

                                // $("#edit_Subcategory_status").val(response.txt_attribute_notice);
                            }

                        });


                    }


                    function deleteFunc(id) {

                        var base_url = "<?=base_url()?>";

                        $.ajax({
                            url: base_url + 'backend/admin/manage_data/subcategory/subcategory/details/' + id,
                            type: 'post',
                            dataType: 'json',
                            async: false,
                            success: function (response) {

                                //alert(response[0].txt_users_username);


                                $("#delete_Subcategory_id").val(response[0].Id);

                                //edit_Subcategory_id

                                // $("#editStatusList").children('[value="'+response[0].fk_int_status_id+'"]').attr('selected', true);

                                // $("#edit_Subcategory").val(response.txt_attribute_notice);
                            }

                        });


                    }




					$(document).ready(function () {







var table;

                function cbDropdown(column) {
                    return $('<ul>', {
                        'class': 'cb-dropdown'
                    }).appendTo($('<div>', {
                        'class': 'cb-dropdown-wrap'
                    }).appendTo(column));
                }

                table = $('#sample_11').DataTable({
                    initComplete: function () {
                        var i = 0;
                        this.api().columns().every(function () {
                            var column = this;

                            if (i == 1 || i==2) {

                                var ddmenu = cbDropdown($(column.header()))
                                    .on('change', ':checkbox', function () {
                                        var active;
                                        var vals = $(':checked', ddmenu).map(function (
                                            index, element) {
                                            active = true;
                                            return $.fn.dataTable.util.escapeRegex(
                                                $(element).val());
                                        }).toArray().join('|');

                                        column
                                            .search(vals.length > 0 ? '^(' + vals +
                                                ')$' : '', true, false)
                                            .draw();

                                        // Highlight the current item if selected.
                                        if (this.checked) {
                                            $(this).closest('li').addClass('active');
                                        } else {
                                            $(this).closest('li').removeClass('active');
                                        }

                                        // Highlight the current filter if selected.
                                        var active2 = ddmenu.parent().is('.active');
                                        if (active && !active2) {
                                            ddmenu.parent().addClass('active');
                                        } else if (!active && active2) {
                                            ddmenu.parent().removeClass('active');
                                        }
                                    });


                                column.data().unique().sort().each(function (d, j) {
                                    var // wrapped
                                        $label = $('<label>'),
                                        $text = $('<span>', {
                                            text: d
                                        }),
                                        $cb = $('<input>', {
                                            type: 'checkbox',
                                            value: d
                                        });

                                    $text.appendTo($label);
                                    $cb.appendTo($label);

                                    ddmenu.append($('<li>').append($label));
                                });


                            }
                            //alert(i);
                            i++;
                        });
                    }
                });




});
                </script>