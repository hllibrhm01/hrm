<?php 
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\AssetsModel;
use App\Models\AssetscategoryModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');

$UsersModel = new UsersModel();
$RolesModel = new RolesModel();
$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
/*
* Arragement Type - View Page
*/
?>
<?php if(in_array('travel1',staff_role_resource()) || in_array('travel_type1',staff_role_resource()) || in_array('travel_calendar',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
<div id="smartwizard-2" class="border-bottom smartwizard-example sw-main sw-theme-default mt-2">
  <ul class="nav nav-tabs step-anchor">
    <?php if(in_array('travel1',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
    <li class="nav-item clickable"> <a href="<?= site_url('erp/business-travel');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon feather icon-globe"></span>
      <?= lang('Dashboard.left_travels');?>
      <div class="text-muted small">
        <?= lang('Main.xin_set_up');?>
        <?= lang('Dashboard.left_travel');?>
      </div>
      </a> </li>
    <?php } ?>
    <?php if(in_array('travel_type1',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
    <li class="nav-item active"> <a href="<?= site_url('erp/arrangement-type');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon fas fa-tasks"></span>
      <?= lang('Employees.xin_arragement_type');?>
      <div class="text-muted small">
        <?= lang('Main.xin_add');?>
        <?= lang('Employees.xin_arragement_type');?>
      </div>
      </a> </li>
    <?php } ?>
    <?php if(in_array('travel_calendar',staff_role_resource()) || $user_info['user_type'] == 'company') { ?>
    <li class="nav-item clickable"> <a href="<?= site_url('erp/travel-calendar');?>" class="mb-3 nav-link"> <span class="sw-done-icon feather icon-check-circle"></span> <span class="sw-icon feather icon-calendar"></span>
      <?= lang('Dashboard.xin_acc_calendar');?>
      <div class="text-muted small">
        <?= lang('Employees.xin_travel_calendar');?>
      </div>
      </a> </li>
    <?php } ?>
  </ul>
</div>
<hr class="border-light m-0 mb-3">
<?php } ?>
<div class="row m-b-1 animated fadeInRight">
  <div class="col-md-12">
    <div class="row m-b-1 animated fadeInRight">
      <?php if(in_array('travel_type2',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header with-elements"> <span class="card-header-title mr-2"><strong>
            <?= lang('Main.xin_add_new');?>
            </strong>
            <?= lang('Employees.xin_arragement_type');?>
            </span> </div>
          <div class="card-body">
            <?php $attributes = array('name' => 'add_arrangement_type', 'id' => 'xin-form', 'autocomplete' => 'off');?>
            <?php $hidden = array('user_id' => 0);?>
            <?= form_open('erp/types/add_arrangement_type', $attributes, $hidden);?>
            <div class="form-group">
              <label for="name">
                <?= lang('Employees.xin_arragement_type');?>
                <span class="text-danger">*</span> </label>
              <input type="text" class="form-control" name="name" placeholder="<?= lang('Employees.xin_arragement_type');?>">
            </div>
          </div>
          <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">
            <?= lang('Main.xin_save');?>
            </button>
          </div>
          <?= form_close(); ?>
        </div>
      </div>
      <?php $colmdval = 'col-md-8';?>
      <?php } else {?>
      <?php $colmdval = 'col-md-12';?>
      <?php } ?>
      <div class="<?= $colmdval;?>">
        <div class="card user-profile-list">
          <div class="card-header with-elements"> <span class="card-header-title mr-2"><strong>
            <?= lang('Main.xin_list_all');?>
            </strong>
            <?= lang('Employees.xin_arragement_type');?>
            </span> </div>
          <div class="card-body">
            <div class="box-datatable table-responsive">
              <table class="datatables-demo table table-striped table-bordered" id="xin_table">
                <thead>
                  <tr>
                    <th><i class="fas fa-braille"></i>
                      <?= lang('Employees.xin_arragement_type');?></th>
                    <th> <?= lang('Main.xin_created_at');?></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
