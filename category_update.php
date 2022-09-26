<?php if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['admin_role'])) {
    include('config.php');
    $breadcrumb_array = array(
        "لوحة التحكم",
        "إدارة التصنيفات",
        "تعديل على بيانات تصنيف"
    );
    include('header.php');
    include('function.php');
?>
    <?php

    if (isset($_GET['update_id']) && !empty($_GET['update_id'])) {
        $update_id = input_secure($_GET['update_id']);
        $result = mysqli_query($connection, "SELECT * from category WHERE ID= ");


        $update_id = input_secure($_GET['update_id']);
        if (isset($_POST['save_form']) && !empty($_POST['save_form'])) {
            $cat_name = input_secure($_POST['cat_name']);
            $cat_type = input_secure($_POST['cat_type']);
            if (isset($_POST['pvalid']) && !empty($_POST['pvalid'])) {
                $pvalid = 1;
            } else {
                $pvalid = 0;
            }


            // Add Row
            mysqli_query($connection, "insert " . $sql_insert_ignore . " category set cat_name='" . $cat_name . "',cat_type='" . $cat_type . "',pvalid='" . $pvalid . "'");
    ?>
            <script language="javascript">
                window.location.href = "category.php";
            </script>
        <?php
        } else {

        ?>
            <!--begin::Dashboard-->
            <!--begin::Card-->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">
                        تعديل تصنيف
                    </h3>
                </div>
                <!--begin::Form-->
                <form class="form" method="post" action="category_add.php">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label text-right">اسم التصنيف</label>
                            <div class="col-lg-9 col-xl-4">
                                <input type="text" class="form-control" name="cat_name" id="cat_name" placeholder="" />
                            </div>
                        </div>

                        <!-- <div class="form-group row">
						<label class="col-lg-3 col-form-label text-right">صورة</label>
						<div class="col-lg-9 col-xl-4">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="companyProfileFile" name="data" id="data">
                                <label class="custom-file-label" for="companyProfileFile"> Choose file </label>
                            </div>
						</div>
					</div> -->
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label text-right">نوع التصنيف</label>
                            <div class="col-lg-9 col-xl-4">
                                <select class="form-control form-control-solid" name="cat_type" id="cat_type">
                                    <option value="1">مقالات</option>
                                    <option value="2">صور</option>
                                    <option value="3">فيدوهات</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label text-right">تفعيل</label>
                            <div class="col-3">
                                <span class="switch switch-icon">
                                    <label>
                                        <input type="checkbox" checked="checked" name="pvalid" id="pvalid" />
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-10">
                                <input type="hidden" name="save_form" id="save_form" value="1">
                                <button type="submit" class="btn btn-success mr-2">حفظ</button>
                                <a href="category.php" class="btn btn-secondary">إلغاء</a>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card-->
            <!--end::Dashboard-->

    <?php
        }
    }else{
        echo "يجب تحديد الصنف الذي ترغب في تعديل بياناته";
    }
    include('footer.php');
} else {
    ?>
    <script language="javascript">
        window.location.href = "index.php?error_msg=1";
    </script>
<?php
}
?>