<?php 
use App\Models\SystemModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\AssetsModel;
use App\Models\ConstantsModel;

$session = \Config\Services::session();
$usession = $session->get('sup_username');

$UsersModel = new UsersModel();
$RolesModel = new RolesModel();		
$ConstantsModel = new ConstantsModel();

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
/* Resignation view
*/
$get_animate = '';
?>
<?php if(in_array('resignation2',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
<div id="add_form" class="collapse add-form <?php echo $get_animate;?>" data-parent="#accordion" style="">
  <div class="card">
    <div id="accordion">
      <div class="card-header">
        <h5>
          <?= lang('Main.xin_add_new');?>
          <?= lang('Employees.xin_resignation');?>
        </h5>
        <div class="card-header-right"> <a  data-toggle="collapse" href="#add_form" aria-expanded="false" class="collapsed btn btn-sm waves-effect waves-light btn-primary m-0"> <i data-feather="minus"></i>
          <?= lang('Main.xin_hide');?>
          </a> </div>
      </div>
      <?php $attributes = array('name' => 'add_resignation', 'id' => 'xin-form', 'autocomplete' => 'off');?>
      <?php $hidden = array('user_id' => 1);?>
      <?php echo form_open('erp/resignation/add_resignation', $attributes, $hidden);?>
      <div class="card-body">
        <div class="row">
          <?php if($user_info['user_type'] == 'company'){?>
          <?php $staff_info = $UsersModel->where('company_id', $usession['sup_user_id'])->where('user_type','staff')->findAll();?>
          <div class="col-md-4">
            <div class="form-group">
              <label for="first_name">
                <?= lang('Dashboard.dashboard_employee');?> <span class="text-danger">*</span>
              </label>
              <select class="form-control" name="employee_id" data-plugin="select_hrm" data-placeholder="<?= lang('Main.xin_choose_an_employee');?>">
                <?php foreach($staff_info as $staff) {?>
                <option value="<?= $staff['user_id']?>">
                <?= $staff['first_name'].' '.$staff['last_name'] ?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <?php $colmd = 'col-md-4'?>
          <?php } else {?>
          <?php $colmd = 'col-md-4'?>
          <?php } ?>
          <div class="<?= $colmd?>">
            <div class="form-group">
              <label for="notice_date">
                <?= lang('Employees.xin_notice_date');?> <span class="text-danger">*</span>
              </label>
              <div class="input-group">
                <input class="form-control date" placeholder="<?= lang('Employees.xin_notice_date');?>" name="notice_date" type="text">
                <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="resignation_date">
                <?= lang('Employees.xin_resignation_date');?> <span class="text-danger">*</span>
              </label>
              <div class="input-group">
                <input class="form-control date" placeholder="<?= lang('Employees.xin_resignation_date');?>" name="resignation_date" type="text">
                <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="reason"> 
                <?= lang('Employees.xin_resignation_reason');?> <span class="text-danger">*</span>
              </label>
              <textarea class="form-control textarea" placeholder="<?= lang('Employees.xin_resignation_reason');?>" name="reason" cols="30" rows="3"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer text-right">
        <button type="reset" class="btn btn-light" href="#add_form" data-toggle="collapse" aria-expanded="false">
        <?= lang('Main.xin_reset');?>
        </button>
        &nbsp;
        <button type="submit" class="btn btn-primary">
        <?= lang('Main.xin_save');?>
        </button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>
<?php } ?>
<div class="card user-profile-list">
  <div class="card-header">
    <h5>
      <?= lang('Main.xin_list_all');?>
      <?= lang('Dashboard.left_resignations');?>
    </h5>
    <?php if(in_array('resignation2',staff_role_resource()) || $user_info['user_type'] == 'company') {?>
    <div class="card-header-right"> <a  data-toggle="collapse" href="#add_form" aria-expanded="false" class="collapsed btn waves-effect waves-light btn-primary btn-sm m-0"> <i data-feather="plus"></i>
      <?= lang('Main.xin_add_new');?>
      </a> </div>
    <?php } ?>
  </div>
  <div class="card-body">
    <div class="box-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="xin_table">
        <thead>
          <tr>
            <th width="400"><i class="fa fa-user"></i>
              <?= lang('Dashboard.dashboard_employee');?></th>
            <th><i class="fa fa-calendar"></i>
              <?= lang('Employees.xin_notice_date');?></th>
            <th><i class="fa fa-calendar"></i>
              <?= lang('Employees.xin_resignation_date');?></th>
            <th><?= lang('Main.dashboard_xin_status');?></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
