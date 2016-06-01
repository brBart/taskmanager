<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.5.4
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>@yield('page_title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" /> -->
        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/mapplic/mapplic/mapplic.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/apps/css/timer.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />

        <link href="/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />


        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="/assets/layouts/layout7/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/layouts/layout7/css/custom.min.css" rel="stylesheet" type="text/css" />
        <link href="/css/app.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
        <style>
        .tm-saving{
            position:absolute;
            top : 0px;
            right: 0px;
            display: none;
        }
        .modal-mask {
          position: fixed;
          z-index: 9998;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 0, 0, .5);
          display: table;
          transition: opacity .3s ease;
        }

        .modal-wrapper {
          display: table-cell;
          vertical-align: middle;
        }

        .modal-container {
          width: 50%;
          margin: 0px auto;
          padding: 20px 30px;
          background-color: #fff;
          border-radius: 2px;
          box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
          transition: all .3s ease;
          font-family: Helvetica, Arial, sans-serif;
        }

        .clickable { cursor: pointer; }

        .modal-header h3 {
          margin-top: 0;
          color: #42b983;
        }

        .modal-body {
          margin: 20px 0;
        }

        .modal-default-button {
          float: right;
        }

        .modal-enter, .modal-leave {
          opacity: 0;
        }

        .modal-enter .modal-container,
        .modal-leave .modal-container {
          -webkit-transform: scale(1.1);
          transform: scale(1.1);
        }

        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url(/assets/apps/img/images.gif) center no-repeat #fff;
        }
        
        .menu-trigger {padding:15px !important;margin-right:5px !important}
        
        
        
        #header {height:47px !important;min-height:47px !important;box-shadow:4px 2px 4px lightgrey }
        
        .page-header .burger-trigger .menu-close {left:0px;top:0px;padding-top:2px !important;padding-left:12px !important;}
        
        .menu-trigger:hover {opacity: 0.5}

        .m-heading-1{ min-height: 250px; }
        
        .tm-notification-area-wrapper {max-height:80vh;opacity: .9;overflow-y: auto}
        
        a.tm-notification:hover {background:lightgrey;opacity: .9 !important}
        
        </style>

        @yield('css')
    <!-- END HEAD -->

    <body id="app" class="page-container-bg-solid">
        <!-- BEGIN HEADER -->
        @if (Auth::check())
        <div id="header" class="page-header navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="clearfix">
                <!-- BEGIN BURGER TRIGGER -->
                <div class="burger-trigger">
                    <button class="menu-trigger">
                        <img src="/assets/layouts/layout7/img/m_toggler.png" alt=""> </button>
                    <div class="menu-overlay menu-overlay-bg-transparent">
                        <div class="menu-overlay-content">
          
                            <ul class="menu-overlay-nav align-center max-width-720px">
                                    <li class="desk-6-12 height-3-10vh " style="padding-top:5vh !important">
                                    <a class="font-26px " href="/tasklists">
                                    <i class="fa fa-tasks font-26px" aria-hidden="true"></i>
                                    <br>
                                    Tasks</a>
                                    <br>
                                    <div class="mob-l-hide">
                                    <span class="font-12px weight-normal">filter by.. </span><br>
                                    <a class=" font-13px" href="/tasklists">Time</a><span class="font-12px weight-normal"> | </span>
                                    <a class=" font-13px" href="/tasklists">Project</a><span class="font-12px weight-normal"> | </span>
                                    <a class=" font-13px" href="/tasklists">Assigned</a>
                                    </div>
                                </li>
                                
                                <li class="desk-6-12 height-3-10vh" style="padding-top:5vh !important">
                                    <a class="font-26px " href="/user/user/viewall/0">
                                    <i class="fa fa-user font-26px" aria-hidden="true"></i>
                                    <br>
                                    Users</a>
                                    <br>
                                    <div class="mob-l-hide">
                                    <span class="font-12px weight-normal">filter by.. </span><br>
                                    <a class=" font-13px" href="/user/user/viewall/0">Team</a><span class="font-12px weight-normal"> | </span>
                                    <a class=" font-13px" href="/user/user/viewall/0">Clients</a><span class="font-12px weight-normal"> | </span>
                                    <a class=" font-13px" href="/user/user/viewall/0">Companies</a>
                                    </div>
                                </li>
                                
                                <li class="desk-6-12 height-2-10vh">
                                    <a class="font-26px " href="/project/viewall/0">
                                    <i class="fa fa-pencil-square-o font-26px" aria-hidden="true"></i>
                                    <br>
                                    Projects</a>
                                    <br>
                                    <div class="mob-l-hide">
                                    <span class="font-12px weight-normal">go to.. </span><br>
                                    <a class=" font-13px" href="/project/viewall/0">Projects</a><span class="font-12px weight-normal"> | </span>
                                    <a class=" font-13px" href="/project/viewall/0">Procedures</a><span class="font-12px weight-normal"> | </span>
                                    <a class=" font-13px" href="/project/viewall/0">Skills</a>
                                    </div>
                                </li>
                                                                
                                <li class="desk-6-12 height-2-10vh">
                                    <a class="font-26px " href="/project/viewall/0">
                                    <i class="fa fa-calculator font-26px" aria-hidden="true"></i>
                                    <br>
                                    Accounting</a>
                                    <br>
                                    <div class="mob-l-hide">
                                    <span class="font-12px weight-normal">go to.. </span><br>
                                    <a class=" font-13px" href="/project/viewall/0">Payroll</a><span class="font-12px weight-normal"> | </span>
                                    <a class=" font-13px" href="/project/viewall/0">Invoices</a><span class="font-12px weight-normal"> | </span>
                                    <a class=" font-13px" href="/project/viewall/0">Reports</a>
                                    </div>
                                </li>
                                
                                 <li class="desk-6-12 height-3-10vh" style="padding-top:7vh !important">
                                    <a class="font-20px " href="/project/viewall/0">
                                    <i class="fa fa-cogs font-20px" aria-hidden="true"></i>
                                    <br>
                                    Settings
                                    <br>
                                    </a>
                                    <div class="mob-l-hide">
                                    <a class=" font-11px" href="/project/viewall/0">General</a><span class="font-12px weight-normal"> | </span>
                                    <a class=" font-11px" href="/project/viewall/0">Notifications</a><span class="font-12px weight-normal"> | </span>
                                    <a class=" font-11px" href="/project/viewall/0">Billing</a>
                                    </div>
                                </li>


                                <li class="desk-6-12 height-3-10vh" style="padding-top:7vh !important">
                                    <a class="font-20px " href="/project/viewall/0">
                                    <i class="fa fa-sign-out font-20px" aria-hidden="true"></i>
                                    <br>
                                    Log out</a>
                                    <div class="mob-l-hide">
                                    <a class=" font-11px" href="/project/viewall/0">See you again soon :)</a>
                                    </div>
                                </li>

                            </ul>
                            
                                                        
                            
                        </div>
                    </div>
                    <div class="menu-bg-overlay">
                        <button class="menu-close clearfix line-40px">&times;</button>
                    </div>
                  
                    <!-- the overlay element -->
                </div>
                <!-- END NAV TRIGGER -->
               
               
                <!-- BEGIN LOGO -->
                <div  class="desk-3-12 mob-l-5-12 mob-p-2-16 pad-13px">
                <a href="/tasklists" class="color-black weight-bolder font-20px">
                <i class="fa fa-hand-o-right font-20px pad-r-0px" aria-hidden="true">
                </i>
                <span class="mob-p-hide">Task Manager</span>
                </a>
                </div>
                <!-- END LOGO -->
                
                
                <div class="desk-7-12 mob-l-6-12 mob-p-8-12 pad-13px float-right">
             
                    <a href="/logout" class="width-auto float-right weight-bolder font-14px pad-r-15px">
                
                <span class="font-14px pad-r-3px mob-l-hide"> Log Out
                </span>
                <i class="fa fa-sign-out" aria-hidden="true">
                </i>
                </a>
             
             
                        <a href="/support" class="width-auto float-right weight-bolder font-14px pad-r-15px">
                
                <span class="font-14px pad-r-3px mob-l-hide"> Support
                </span>
                <i class="fa fa-life-ring" aria-hidden="true">
                </i>
                </a>
             
                             <a class="width-auto float-right pad-r-15px" href="#" class="weight-bolder font-16px">
                <i class="fa fa-bell-o" aria-hidden="true">
                </i>
                <span class="font-14px"> @{{ userNotificationCount }} </span><span @click="ShowHideNotificationArea($event)" class="mob-l-hide">Notifications</span>  
                </a>
             
                  <a class="pad-r-15px width-auto float-right" href="/profile/edit" class="color-black font-30px">
                <span class="font-14px weight-bold mob-p-hide"> {{ Auth::user()->first_name }}
                </span>
                <span class="pad-r-5px font-14px weight-bold tab-l-hide"> {{ Auth::user()->last_name }}
                </span>
                <div class="width-auto float-right" 
                        style="background: lightgrey url('{{ Auth::user()->get_photo() }}') repeat scroll center center / cover;min-width:20px;min-height:20px;"> </div>
                
                </a>

                
                </div>  

  
   <div class="tm-notification-area-wrapper desk-full background-white pad-15px" v-show="showHideNotification" style="box-shadow: 2px 2px 4px grey">
            
    <div class="font-16px weight-normal pad-b-5px" style="color:#117cb8;">Notifications</div>

<!--Notification--> 
        
        <div v-for="un in userNotification" class="desk-2-12 tab-l-4-12 tab-p-6-12 mob-l-full pad-b-10px">
        
        <a class="tm-notification-area" @click="ShowHideNotificationArea($event)" href="#task-id-@{{ un.id }}">
        
        <div  class="tm-notification pad-l-15px pad-r-20px " style="border-left: 3px solid #117cb8;">
                
                        <div class="desk-full font-333 font-12px pad-b-5px pad-t-10px"><span class="tm-status-header weight-bold">@{{ un.project.project_name }}</span></div>

            <div class="desk-full font-333 font-16px pad-b-5px">@{{ un.title }}</div>
            <div class="desk-full font-333 font-12px pad-b-20px"><span class="tm-status-header weight-bold">@{{ un.status }} </span><span class="font-12px">STATUS</span></div>
           <div class="width-auto float-left" style="background: lightgrey url('{{ Auth::user()->get_photo() }}') repeat scroll center center / cover;min-width:33px;min-height:33px;max-width:33px;max-height:33px;margin-right:10px"> 
            </div>
           
            <span class="font-14px weight-bold mob-p-hide"> 
            @{{ un.comment.user.first_name }}
            </span>
            <span class="pad-r-5px font-14px weight-bold tab-l-hide"> 
            @{{ un.comment.user.last_name }}
            </span>
                <br>
                <span style="display:inline-block" class="pad-t-5px pad-r-5px font-10px color-333">
                @{{ un.comment.created_at }},                              
                </span>
                
                <div class="clear-fix">&nbsp</div>

                  <i class="fa fa-comments font-14px mob-p-font-14px "><span class="font-14px" v-text="un.comment.content | strip_tags 48" >  </span><span class="font-12px weight-normal"> &nbsp;&nbsp; more »</span>
            </i>

    
        </div>
            </a>
        </div>  
        
          
    
    
    
    
    
    
    </div>


                
                                 


                        </div>
            <!-- END HEADER INNER -->
        </div>
        @endif



        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container page-content-inner page-container-bg-solid">
            
            

            <!-- BEGIN CONTENT -->
            <div id="loader" class="se-pre-con" v-show="showLoader"></div>

            <div id="main-content" class="container-fluid container-lf-space">
                <!-- BEGIN PAGE BASE CONTENT -->
               
                    @yield('content')

                <!-- END PAGE BASE CONTENT -->


            </div>

            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->

        <!-- BEGIN FOOTER -->
        <div class="page-footer desk-full min-height-40px">
                    
                <div class="desk-3-12 mob-p-full mob-p-align-center font-14px line-20px" style="padding-left:8px;padding-top:0px">
                    <a href="http://cloudology.codes" class="weight-normal font-11px pad-r-15px color-grey" target="_blank">
                    Copyright © 2016<span class="tab-p-hide mob-p-show">
                <span class="mob-p-hide"> | <i class="fa fa-hand-o-right font-12px pad-r-0px" aria-hidden="true">
                </i> Task Manager</span>
                    </a>
                </div>
                
                
            <div class="desk-9-12 pad-r-3-12 align-center pad-t-10px mob-p-hide">
                <a href="/support" class="weight-bolder font-14px ">
                
                
                <span class="font-12px pad-r-3px "> Tasks
                </span>
                </a>
                <span style="color:#D3D3D3;"> | </span>


                <a href="/support" class="weight-bolder font-12px ">
                
                <span class="font-12px pad-r-3px "> Users
                </span>

                </a>

                <span style="color:#D3D3D3;"> | </span>

                <a href="/support" class="weight-bolder font-12px ">
                
               
                <span class="font-12px pad-r-3px "> Projects
                </span>
                </a>

                <span style="color:#D3D3D3;"> | </span>

                <a href="/support" class="weight-bolder font-12px ">
                
                
                <span class="font-12px pad-r-3px "> Accounting
                </span>
                </a>
                
                <span style="color:#D3D3D3;"> | </span>
                
                <a href="/support" class="weight-bolder font-12px ">
                
                
                <span class="font-12px pad-r-3px "> Settings
                </span>
                </a>
                
                <span class=" mob-l-hide" style="color:#D3D3D3;"> | </span>
                
                <a href="/support" class="weight-bolder font-12px mob-l-hide">
                
                
                <span class="font-12px pad-r-3px "> Support
                </span>
                </a>
                
                <span style="color:#D3D3D3;"> | </span>
                
                <a href="/support" class="weight-bolder font-12px ">
                
                
                <span class="font-12px pad-r-3px "> Logout
                </span>
                </a>
                
        </div>

                



            <div class="go2top font-18px pad-4px">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <!-- BEGIN QUICK SIDEBAR TOGGLER -->
       <!-- <button type="button" class="quick-sidebar-toggler" data-toggle="collapse">
            <span class="sr-only">Toggle Quick Sidebar</span>
            <i class="icon-logout"></i>
            <div class="quick-sidebar-notification">
                <span class="badge badge-danger">7</span>
            </div>
        </button>-->
        <!-- template for the modal component -->
            <script type="x/template" id="modal-template">
              <div class="modal-mask" v-show="show" transition="modal"> 

                <div class="modal-wrapper">
                  <div class="modal-container">
                    <span class="clickable" style="position:relative;top:-37px;right:-103%;font-weight:bold;font-size:28px;background-color:green" @click="show = false">X</span>

                    <div class="modal-header">
                      <slot name="header">
                        default header
                      </slot>
                    </div>
                    
                    <div class="modal-body">
                      <slot name="body">
                        default body
                      </slot>
                    </div>

                    <div class="modal-footer">
                      <slot name="footer">
                        default footer
                      </slot>
                    </div>
                  </div>
                </div>
              </div>
            </script>
            <!--END -->
        <!-- END QUICK SIDEBAR TOGGLER -->
        <!--[if lt IE 9]>
<script src="/assets/global/plugins/respond.min.js"></script>
<script src="/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->

        <!-- BEGIN CORE PLUGINS -->
        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/mapplic/js/hammer.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/mapplic/js/jquery.easing.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/mapplic/js/jquery.mousewheel.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/mapplic/mapplic/mapplic.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/socket.io/socket.io-1.4.5.js"></script>
        <script src="/assets/apps/scripts/timer.js" type="text/javascript"></script>
        <!--<script src='/js/libs/tinymce/tinymce.min.js'></script>         -->

        <script src="/assets/global/scripts/app.min.js" type="text/javascript"></script>
    
        <script src="/assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/components-date-time-pickers.min.js" type="text/javascript"></script>
        <script src='/js/libs/tinymce/tiny_mce.js'></script>

         <script src='/js/libs/tinymce/tiny_mce.js'></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
      <!--  <script src="/assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>-->
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="/assets/layouts/layout7/scripts/layout.min.js" type="text/javascript"></script>
        <script src="/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script src="/js/libs/vue/vue.min.js"></script>
        <script src="/js/libs/vue/vue-resource.min.js"></script>
        <!-- <script src="/js/libs/vue/vue-router.min.js"></script> -->
        <script src="/config.json"></script>
        <script src="/js/func.js"></script>
        <!-- <script src="/js/global.js"></script> -->
        @yield('javascripts')
        <script >
              
            var main = {

                data: function(){
                    
                        return { 
                                showLoader :true ,   
                                med : {
                                        path :  '/assets/apps/img/photos/preview.png',
                                },

                                @if(Auth::check())    

                                    authUser :{

                                                id : '{!! Auth::user()->id !!}',
                                                first_name : '{!! Auth::user()->first_name !!}',
                                                last_name : '{!! Auth::user()->last_name !!}',
                                                company_id : '{!! Auth::user()->company_id !!}',
                                                position : '{!! Auth::user()->position !!}',
                                                phone : '{!! Auth::user()->phone !!}',
                                                city : '{!! Auth::user()->city !!}',
                                                email : '{!! Auth::user()->email !!}',
                                                country : '{!! Auth::user()->country !!}',
                                                timezone : '{!! Auth::user()->timezone !!}',
                                                role_id : '{!! Auth::user()->role_id !!}',
                                                role :  '{!! Auth::user()->role() !!}',
                                                photo : '{!! Auth::user()->get_photo() !!}',
                                                is_admin : '{!! Auth::user()->is_admin() !!}',
                                                is_developer : '{!! Auth::user()->is_developer() !!}',
                                                is_client : '{!! Auth::user()->is_client() !!}',
                                             }
                                @else 
                                    authUser :{

                                                role_id : '', 


                                             }
                                @endif


                                }
                       },

                ready: function(){
                        this.showLoader= false;
                        this.FetchUserNotificationCount();

                        $(".se-pre-con").css('display','none');
                },

             
            }  

        </script>

        <script src="/js/app.js"></script>
    </body>

</html>
