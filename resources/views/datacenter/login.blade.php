@php
$configData = Helper::appClasses();
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'เข้าสู่ระบบ')

@section('vendor-style')
<!-- Vendor -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endsection

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/pages-auth.js')}}"></script>
@endsection

@section('content')
<div class="authentication-wrapper authentication-cover">
  <div class="authentication-inner row m-0">
    <!-- /Left Text -->
    <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center">
      <div class="flex-row text-center mx-auto">
        <img src="{{asset('assets/img/pages/login-cover.png')}}" alt="Auth Cover Bg color" width="520" class="img-fluid authentication-cover-img" data-app-light-img="pages/login-light.png" data-app-dark-img="pages/login-dark.png">
        <div class="mx-auto">
          <h3>โครงการพัฒนาศูนย์ข้อมูลเพื่อการวิเคราะห์และรายงานคุณภาพสิ่งแวดล้อม</h3>
          <p>
            PCD's Data Center for Environmental Quality Analysis and Report.
          </p>
        </div>
      </div>
    </div>
    <!-- /Left Text -->

    <!-- Login -->
    <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
      <div class="w-px-400 mx-auto">
        <!-- Logo -->
        <div class="app-brand mb-4">
          <img src="{{asset('assets/img/logo.png')}}" style="max-width: 30%;" class="mx-auto d-block">
        </div>
        <!-- /Logo -->
        <h4 class="mb-2 text-center">ยินดีต้อนรับเข้าสู่ระบบ<br> PCD's {{config('variables.templateName')}}</h4>
        <p class="mb-4">เข้าสู่ระบบเพื่อจัดการฐานข้อมูลสำหรับเจ้าหน้าที่และผู้บริหาร</p>

        <form id="formAuthentication" class="mb-3" action="{{url('/')}}" method="GET">
          <div class="mb-3">
            <label for="email" class="form-label">อีเมลล์</label>
            <input type="text" class="form-control" id="email" name="email-username" placeholder="กรุณากรอกอีเมลล์ของท่าน" autofocus>
          </div>
          <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="password">รหัสผ่าน</label>
              <a href="javascript:void(0);">
                <small>ลืมรหัสผ่านใช่หรือไม่?</small>
              </a>
            </div>
            <div class="input-group input-group-merge">
              <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
              <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
          </div>
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="remember-me">
              <label class="form-check-label" for="remember-me">
                จดจำข้อมูล
              </label>
            </div>
          </div>
          <button class="btn btn-primary d-grid w-100">
            เข้าสู่ระบบ
          </button>
        </form>

        {{-- <p class="text-center">
          <span>New on our platform?</span>
          <a href="{{url('auth/register-cover')}}">
            <span>Create an account</span>
          </a>
        </p>

        <div class="divider my-4">
          <div class="divider-text">or</div>
        </div>

        <div class="d-flex justify-content-center">
          <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
            <i class="tf-icons bx bxl-facebook"></i>
          </a>

          <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
            <i class="tf-icons bx bxl-google-plus"></i>
          </a>

          <a href="javascript:;" class="btn btn-icon btn-label-twitter">
            <i class="tf-icons bx bxl-twitter"></i>
          </a>
        </div>


         --}}
      </div>
    </div>
    <!-- /Login -->
  </div>
</div>
@endsection
