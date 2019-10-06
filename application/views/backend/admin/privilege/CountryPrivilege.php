<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PORTLET-->
        <div class="portlet light form-fit bordered">

            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">Privilege Settings</span>
                </div>
                <div class="actions">

                </div>
            </div>

            <br>

            <div class="portlet-body form">
                <div class="row">

                </div>


                <br><br>



                <form action="<?=base_url('backend/admin/privilege/adminprivilege/update')?>" method="post" id="AdminPrivilege">

                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i>User </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title=""
                                    title=""> </a>
                                <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                                <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Privilege Name </th>
                                            <th> Add </th>
                                            <th> Edit</th>
                                            <th> Delete </th>
                                            <th> View </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td> 1 </td>
                                            <td> Admin </td>


                                            <td> <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="AdminAdd" name="permission[]" <?=(in_array('AdminAdd',
                                                        $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                                    <span></span>
                                                </label>
                                            </td>

                                            <td> <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="AdminEdit" name="permission[]" <?=(in_array('AdminEdit',
                                                        $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                                    <span></span>
                                                </label> </td>

                                            <td> <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="AdminDelete" name="permission[]" <?=(in_array('AdminDelete',
                                                        $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                                    <span></span>
                                                </label> </td>

                                            <td> <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="AdminView" name="permission[]" <?=(in_array('AdminView',
                                                        $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                                    <span></span>
                                                </label> </td>

                                        </tr>


                                        <tr>
                                            <td> 2 </td>
                                            <td> Dealer </td>
                                            <td> <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="DealerAdd" name="permission[]" <?=(in_array('DealerAdd',
                                                        $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td> <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="DealerEdit" name="permission[]" <?=(in_array('DealerEdit',
                                                        $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                                    <span></span>
                                                </label> </td>
                                            <td> <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="DealerDelete" name="permission[]" <?=(in_array('DealerDelete',
                                                        $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                                    <span></span>
                                                </label> </td>
                                            <td> <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="DealerView" name="permission[]" <?=(in_array('DealerView',
                                                        $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                                    <span></span>
                                                </label> </td>

                                        </tr>

                                        <tr>
                                            <td> 3 </td>
                                            <td> Vendor </td>
                                            <td> <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="VendorAdd" name="permission[]"
                                                        disabled>
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td> <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="VendorEdit" name="permission[]"
                                                        disabled>
                                                    <span></span>
                                                </label> </td>
                                            <td> <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="VendorDelete" name="permission[]"
                                                        disabled>
                                                    <span></span>
                                                </label> </td>
                                            <td> <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="VendorView" name="permission[]" <?=(in_array('VendorView',
                                                        $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                                    <span></span>
                                                </label> </td>

                                        </tr>


                                        <tr>
                                            <td> 4 </td>
                                            <td> Supervisor </td>
                                            <td> <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="SupervisorAdd" name="permission[]"
                                                        disabled>
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td> <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="SupervisorEdit" name="permission[]"
                                                        disabled>
                                                    <span></span>
                                                </label> </td>
                                            <td> <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="SupervisorDelete" name="permission[]"
                                                        disabled>
                                                    <span></span>
                                                </label> </td>
                                            <td> <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="SupervisorView" name="permission[]"
                                                        <?=(in_array('SupervisorView', $this->data['CountryPrivilege']))
                                                    ? 'checked' : ''?> >
                                                    <span></span>
                                                </label> </td>

                                        </tr>

                                        <tr>
                                            <td> 5 </td>
                                            <td> Customer </td>
                                            <td> <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="CustomerAdd" name="permission[]"
                                                        disabled>
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td> <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="CustomerEdit" name="permission[]"
                                                        disabled>
                                                    <span></span>
                                                </label> </td>
                                            <td> <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="CustomerDelete" name="permission[]"
                                                        disabled>
                                                    <span></span>
                                                </label> </td>
                                            <td> <label class="mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" value="CustomerView" name="permission[]" <?=(in_array('CustomerView',
                                                        $this->data['CountryPrivilege'])) ? 'checked' : ''?> >
                                                    <span></span>
                                                </label> </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>









            </div>
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>General </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
                        </a>
                        <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                        <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Privilege Name </th>
                                    <th> Add </th>
                                    <th> Edit</th>
                                    <th> Delete </th>
                                    <th> View </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td> 1 </td>
                                    <td> Country </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="CountryAdd" name="permission[]" <?=(in_array('CountryAdd',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="CountryEdit" name="permission[]" <?=(in_array('CountryEdit',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="CountryDelete" name="permission[]" <?=(in_array('CountryDelete',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="CountryView" name="permission[]" <?=(in_array('CountryView',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>

                                </tr>

                                <tr>
                                    <td> 2 </td>
                                    <td> State </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="StateAdd" name="permission[]" <?=(in_array('StateAdd',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="StateEdit" name="permission[]" <?=(in_array('StateEdit',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="StateDelete" name="permission[]" <?=(in_array('StateDelete',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="StateView" name="permission[]" <?=(in_array('StateView',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>

                                </tr>


                                <tr>
                                    <td> 3 </td>
                                    <td> City </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="CityAdd" name="permission[]" <?=(in_array('CityAdd',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="CityEdit" name="permission[]" <?=(in_array('CityEdit',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="CityDelete" name="permission[]" <?=(in_array('CityDelete',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="CityView" name="permission[]" <?=(in_array('CityView',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>

                                </tr>

                                <tr>
                                    <td> 4 </td>
                                    <td> Area </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="AreaAdd" name="permission[]" <?=(in_array('AreaAdd',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="AreaEdit" name="permission[]" <?=(in_array('AreaEdit',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="AreaDelete" name="permission[]" <?=(in_array('AreaDelete',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="AreaView" name="permission[]" <?=(in_array('AreaView',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>

                                </tr>
                                <tr>
                                    <td>5 </td>
                                    <td> Currency </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="CurrencyAdd" name="permission[]" <?=(in_array('CurrencyAdd',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="CurrencyEdit" name="permission[]" <?=(in_array('CurrencyEdit',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="CurrencyDelete" name="permission[]" <?=(in_array('CurrencyDelete',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="CurrencyView" name="permission[]" <?=(in_array('CurrencyView',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>

                                </tr>
                                <tr>
                                    <td>6 </td>
                                    <td> Shipping Distance </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ShippingDistanceAdd" name="permission[]" <?=(in_array('ShippingDistanceAdd',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ShippingDistanceEdit" name="permission[]" <?=(in_array('ShippingDistanceEdit',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ShippingDistanceDelete" name="permission[]"
                                                <?=(in_array('ShippingDistanceDelete', $this->data['CountryPrivilege']))
                                            ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ShippingDistanceView" name="permission[]" <?=(in_array('ShippingDistanceView',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>







            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Manage Data </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
                        </a>
                        <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                        <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Privilege Name </th>
                                    <th> Add </th>
                                    <th> Edit</th>
                                    <th> Delete </th>
                                    <th> View </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td> 1 </td>
                                    <td> LanguageMaster </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="LanguageMasterAdd" name="permission[]" <?=(in_array('LanguageMasterAdd',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="LanguageMasterEdit" name="permission[]" <?=(in_array('LanguageMasterEdit',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="LanguageMasterDelete" name="permission[]" <?=(in_array('LanguageMasterDelete',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="LanguageMasterView" name="permission[]" <?=(in_array('LanguageMasterView',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>

                                </tr>

                                <tr>
                                    <td> 2 </td>
                                    <td> Label </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="LabelAdd" name="permission[]" <?=(in_array('LabelAdd',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="LabelEdit" name="permission[]" <?=(in_array('LabelEdit',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="LabelDelete" name="permission[]" <?=(in_array('LabelDelete',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="LabelView" name="permission[]" <?=(in_array('LabelView',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>

                                </tr>


                                <tr>
                                    <td> 3 </td>
                                    <td> Category </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="CategoryAdd" name="permission[]" <?=(in_array('CategoryAdd',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="CategoryEdit" name="permission[]" <?=(in_array('CategoryEdit',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="CategoryDelete" name="permission[]" <?=(in_array('CategoryDelete',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="CategoryView" name="permission[]" <?=(in_array('CategoryView',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>

                                </tr>

                                <tr>
                                    <td> 4 </td>
                                    <td> SubCategory </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="SubCategoryAdd" name="permission[]" <?=(in_array('SubCategoryAdd',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="SubCategoryEdit" name="permission[]" <?=(in_array('SubCategoryEdit',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="SubCategoryDelete" name="permission[]" <?=(in_array('SubCategoryDelete',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="SubCategoryView" name="permission[]" <?=(in_array('SubCategoryView',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?> >
                                            <span></span>
                                        </label> </td>

                                </tr>
                                <tr>
                                    <td>5 </td>
                                    <td> ManageLanguage </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ManageLanguageAdd" name="permission[]"
                                                disabled>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ManageLanguageEdit" name="permission[]"
                                                disabled>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ManageLanguageDelete" name="permission[]"
                                                disabled>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ManageLanguageView" name="permission[]" <?=(in_array('ManageLanguageView',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?> >
                                            <span></span>
                                        </label> </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Manage Product </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
                        </a>
                        <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                        <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Privilege Name </th>
                                    <th> Add </th>
                                    <th> Edit</th>
                                    <th> Delete </th>
                                    <th> View </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td> 1 </td>
                                    <td> UnitMaster </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="UnitMasterAdd" name="permission[]" <?=(in_array('UnitMasterAdd',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="UnitMasterEdit" name="permission[]" <?=(in_array('UnitMasterEdit',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="UnitMasterDelete" name="permission[]" <?=(in_array('UnitMasterDelete',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="UnitMasterView" name="permission[]" <?=(in_array('UnitMasterView',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>

                                </tr>

                                <tr>
                                    <td> 2 </td>
                                    <td> Product </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ProductAdd" name="permission[]" <?=(in_array('ProductAdd',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ProductEdit" name="permission[]" <?=(in_array('ProductEdit',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ProductDelete" name="permission[]" <?=(in_array('ProductDelete',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ProductView" name="permission[]" <?=(in_array('ProductView',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>

                                </tr>


                                <tr>
                                <tr>
                                    <td>3 </td>
                                    <td> ManageLanguage </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ManageLanguageAdd" name="permission[]"
                                                disabled>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ManageLanguageEdit" name="permission[]"
                                                disabled>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ManageLanguageDelete" name="permission[]"
                                                disabled>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ManageProductManageLanguageView" name="permission[]"
                                                <?=(in_array('ManageProductManageLanguageView', $this->data['CountryPrivilege']))
                                            ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>

                                </tr>

                                <tr>
                                    <td> 4 </td>
                                    <td> ProductTemplate </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ProductTemplateAdd" name="permission[]" <?=(in_array('ProductTemplateAdd',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ProductTemplateEdit" name="permission[]" <?=(in_array('ProductTemplateEdit',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ProductTemplateDelete" name="permission[]" <?=(in_array('ProductTemplateDelete',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ProductTemplateView" name="permission[]" <?=(in_array('ProductTemplateView',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>

                                </tr>


                            </tbody>
                        </table>

                    </div>


                </div>



            </div>




            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Product Request </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
                        </a>
                        <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                        <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Privilege Name </th>
                                    <th> Add </th>
                                    <th> Edit</th>
                                    <th> Delete </th>
                                    <th> View </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td> 1 </td>
                                    <td> Product Request List </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ProductRequestAdd" name="permission[]" <?=(in_array('ProductRequestAdd',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ProductRequestEdit" name="permission[]"
                                                disabled>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ProductRequestDelete" name="permission[]"
                                                disabled>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="ProductRequestView" name="permission[]" <?=(in_array('ProductRequestView',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>

                                </tr>






                            </tbody>
                        </table>

                    </div>


                </div>



            </div>


            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Loyalty Config </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
                        </a>
                        <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                        <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Privilege Name </th>
                                    <th> Add </th>
                                    <th> Edit</th>
                                    <th> Delete </th>
                                    <th> View </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td> 1 </td>
                                    <td> Config </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="LoyaltyConfigAdd" name="permission[]"
                                                disabled>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="LoyaltyConfigEdit" name="permission[]"
                                                disabled>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="LoyaltyConfigDelete" name="permission[]"
                                                disabled>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="LoyaltyConfigView" name="permission[]" <?=(in_array('LoyaltyConfigView',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>

                                </tr>






                            </tbody>
                        </table>

                    </div>


                </div>



            </div>
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Privilege </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
                        </a>
                        <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                        <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Privilege Name </th>
                                    <th> Add </th>
                                    <th> Edit</th>
                                    <th> Delete </th>
                                    <th> View </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td> 1 </td>
                                    <td> Country Privilege </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="CountryPrivilegeAdd" name="permission[]"
                                                disabled>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="CountryPrivilegeEdit" name="permission[]"
                                                disabled>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="CountryPrivilegeDelete" name="permission[]"
                                                disabled>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="CountryPrivilegeView" name="permission[]" <?=(in_array('CountryPrivilegeView',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>

                                </tr>

                                <tr>
                                    <td> 2 </td>
                                    <td> Dealer Privilege </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="DealerPrivilegeAdd" name="permission[]"
                                                disabled>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="DealerPrivilegeEdit" name="permission[]"
                                                disabled>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="DealerPrivilegeDelete" name="permission[]"
                                                disabled>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="DealerPrivilegeView" name="permission[]" <?=(in_array('DealerPrivilegeView',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?>>
                                            <span></span>
                                        </label> </td>

                                </tr>


                                <tr>
                                <tr>
                                    <td>3 </td>
                                    <td> Vendor Privilege </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="VendorPrivilegeAdd" name="permission[]"
                                                disabled>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="VendorPrivilegeEdit" name="permission[]"
                                                disabled>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="VendorPrivilegeDelete" name="permission[]"
                                                disabled>
                                            <span></span>
                                        </label> </td>
                                    <td> <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="VendorPrivilegeView" name="permission[]" <?=(in_array('VendorPrivilegeView',
                                                $this->data['CountryPrivilege'])) ? 'checked' : ''?> >
                                            <span></span>
                                        </label> </td>

                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>


            </div>




            <center>

                <input type="submit" class="btn green " id="template_update" value='update'>

            </center>


        </div>



    </div>






    </form>






</div>

<script>
    $('#AdminPrivilege').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=base_url('backend/admin/privilege/adminprivilege/update')?>",
            data: $('#AdminPrivilege').serialize(),
            dataType: "json",
            success: function (response) {


                swal({
                    title: "Successfully Update Admin Privilege ",
                    text: "",
                    type: "success",
                });

            }
        });

    });
</script>