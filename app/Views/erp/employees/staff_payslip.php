<?php
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\ShiftModel;
use App\Models\SystemModel;
use App\Models\CountryModel;
use App\Models\ConstantsModel;
use App\Models\DepartmentModel;
use App\Models\DesignationModel;
use App\Models\StaffdetailsModel;
//$encrypter = \Config\Services::encrypter();
$ShiftModel = new ShiftModel();
$SystemModel = new SystemModel();
$RolesModel = new RolesModel();
$UsersModel = new UsersModel();
$CountryModel = new CountryModel();
$ConstantsModel = new ConstantsModel();
$DepartmentModel = new DepartmentModel();
$DesignationModel = new DesignationModel();
$StaffdetailsModel = new StaffdetailsModel();

$session = \Config\Services::session();
$usession = $session->get('sup_username');
$request = \Config\Services::request();

///
$segment_id = $request->uri->getSegment(3);
$user_id = udecode($segment_id);
$result = $UsersModel->where('user_id', $user_id)->first();
$employee_detail = $StaffdetailsModel->where('user_id', $result['user_id'])->first();

$user_info = $UsersModel->where('user_id', $usession['sup_user_id'])->first();
if($user_info['user_type'] == 'staff'){
	$departments = $DepartmentModel->where('company_id',$user_info['company_id'])->orderBy('department_id', 'ASC')->findAll();
	$designations = $DesignationModel->where('company_id',$user_info['company_id'])->where('department_id',$employee_detail['department_id'])->orderBy('designation_id', 'ASC')->findAll();
	$office_shifts = $ShiftModel->where('company_id',$user_info['company_id'])->orderBy('office_shift_id', 'ASC')->findAll();
	$leave_types = $ConstantsModel->where('company_id',$user_info['company_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
} else {
	$departments = $DepartmentModel->where('company_id',$usession['sup_user_id'])->orderBy('department_id', 'ASC')->findAll();
	$designations = $DesignationModel->where('company_id',$usession['sup_user_id'])->where('department_id',$employee_detail['department_id'])->orderBy('designation_id', 'ASC')->findAll();
	$office_shifts = $ShiftModel->where('company_id',$usession['sup_user_id'])->orderBy('office_shift_id', 'ASC')->findAll();
	$leave_types = $ConstantsModel->where('company_id',$usession['sup_user_id'])->where('type','leave_type')->orderBy('constants_id', 'ASC')->findAll();
}

$all_countries = $CountryModel->orderBy('country_id', 'ASC')->findAll();
$religion = $ConstantsModel->where('type','religion')->orderBy('constants_id', 'ASC')->findAll();
$roles = $RolesModel->orderBy('role_id', 'ASC')->findAll();
$selected_shift = $ShiftModel->where('office_shift_id', $employee_detail['office_shift_id'])->first();
?>

<div class="mb-3 sw-container tab-content">
  <div id="smartwizard-2" class="smartwizard-example sw-main sw-theme-default">
    <ul class="nav nav-tabs step-anchor">
      <li class="nav-item clickable"> <a href="<?= site_url('erp/employee-details/').$segment_id;?>" class="mb-3 nav-link"> <span class="sw-done-icon ion lnr lnr-users"></span> <span class="sw-icon lnr lnr-users"></span>
        <?= lang('xin_general');?>
        <div class="text-muted small">
          <?= lang('xin_e_details_basic');?>
        </div>
        </a> </li>
      <?php //if(in_array('351',$role_resources_ids)) { ?>
      <li class="nav-item clickable"> <a href="<?= site_url('erp/employee-salary/').$segment_id;?>" class="mb-3 nav-link"> <span class="sw-done-icon lnr lnr-highlight"></span> <span class="sw-icon lnr lnr-highlight"></span>
        <?= lang('xin_employee_set_salary');?>
        <div class="text-muted small">
          <?= lang('xin_set_up').' '. lang('xin_employee_set_salary');?>
        </div>
        </a> </li>
      <?php //} ?>
      <li class="nav-item clickable"> <a href="<?= site_url('erp/employee-leave/').$segment_id;?>" class="mb-3 nav-link"> <span class="sw-done-icon lnr lnr-calendar-full"></span> <span class="sw-icon lnr lnr-calendar-full"></span>
        <?= lang('left_leaves');?>
        <div class="text-muted small">
          <?= lang('xin_view_leave_all');?>
        </div>
        </a> </li>
      <li class="nav-item clickable"> <a href="<?= site_url('erp/employee-corehr/').$segment_id;?>" class="mb-3 nav-link"> <span class="sw-done-icon lnr lnr-earth"></span> <span class="sw-icon lnr lnr-earth"></span>
        <?= lang('xin_hr');?>
        <div class="text-muted small">
          <?= lang('xin_view_core_hr_modules');?>
        </div>
        </a> </li>
      <li class="nav-item clickable"> <a href="<?= site_url('erp/employee-projects-tasks/').$segment_id;?>" class="mb-3 nav-link"> <span class="sw-done-icon lnr lnr-layers"></span> <span class="sw-icon lnr lnr-layers"></span>
        <?= lang('xin_hr_m_project_task');?>
        <div class="text-muted small">
          <?= lang('xin_view_all_projects');?>
        </div>
        </a> </li>
      <li class="nav-item active"> <a href="<?= site_url('erp/employee-payslip/').$segment_id;?>" class="mb-3 nav-link"> <span class="sw-done-icon lnr lnr-keyboard"></span> <span class="sw-icon lnr lnr-keyboard"></span>
        <?= lang('left_payslips');?>
        <div class="text-muted small">
          <?= lang('xin_view_payslips_all');?>
        </div>
        </a> </li>
    </ul>
    <hr class="border-light mb-3 m-0">
    <div class="card">
      <div class="card-header with-elements"> <span class="card-header-title mr-2"> <strong>
        <?= lang('xin_list_all');?>
        </strong>
        <?= lang('left_payment_history');?>
        </span> </div>
      <?php //$history = $this->Payroll_model->get_payroll_slip($user_id); ?>
      <div class="card-body">
        <div class="box-datatable table-responsive">
          <table class="datatables-demo table table-striped table-bordered xin_ci_table" id="xin_hr_table">
            <thead>
              <tr>
                <th><?= lang('xin_action');?></th>
                <th><?= lang('xin_payroll_net_payable');?></th>
                <th><?= lang('xin_salary_month');?></th>
                <th><i class="fa fa-calendar"></i>
                  <?= lang('xin_payroll_date_title');?></th>
                <th><?= lang('dashboard_xin_status');?></th>
              </tr>
            </thead>
            <tbody>
              <?php //foreach($history->result() as $r) {} ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
