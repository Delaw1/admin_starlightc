 <!-- sidebar -->
 <div class="app-sidebar sidebar-shadow">
     <div class="app-header__logo">
         <div class="logo-src"></div>
         <div class="header__pane ml-auto">
             <div>
                 <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                     <span class="hamburger-box">
                         <span class="hamburger-inner"></span>
                     </span>
                 </button>
             </div>
         </div>
     </div>
     <div class="app-header__mobile-menu">
         <div>
             <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                 <span class="hamburger-box">
                     <span class="hamburger-inner"></span>
                 </span>
             </button>
         </div>
     </div>
     <div class="app-header__menu">
         <span>
             <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                 <span class="btn-icon-wrapper">
                     <i class="fa fa-ellipsis-v fa-w-6"></i>
                 </span>
             </button>
         </span>
     </div>
     <div class="scrollbar-sidebar">
         <div class="app-sidebar__inner">
             <ul class="vertical-nav-menu">
                 <li class="app-sidebar__heading"></li>
                 <li>
                     <a href="/" class="mm-active">
                         <i class="metismenu-icon pe-7s-rocket"></i>
                         Dashboard
                     </a>
                 </li>
                 @if(Auth::User()->role == 'admin')
                 <li>
                     <a href="#">
                         <i class="metismenu-icon pe-7s-diamond "></i>
                         Projects
                         <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                     </a>
                     <ul>
                         <li>
                             <a href="/submitted_projects">
                                 <i class="metismenu-icon"></i> Submitted Projects
                             </a>
                         </li>
                         <li>
                             <a href="/approved_projects">
                                 <i class="metismenu-icon">
                                 </i>Approved projects
                             </a>
                         </li>
                         <li>
                             <a href="/unassigned_projects">
                                 <i class="metismenu-icon">
                                 </i>Unassigned projects
                             </a>
                         </li>
                         <li>
                             <a href="/ongoing_projects">
                                 <i class="metismenu-icon">
                                 </i>Ongoing projects
                             </a>
                         </li>
                         <li>
                             <a href="/completed_projects">
                                 <i class="metismenu-icon">
                                 </i>Completed projects
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li>
                     <a href="#">
                         <i class="metismenu-icon pe-7s-diamond "></i>
                         Writers
                         <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                     </a>
                     <ul>
                         <li>
                             <a href="/approve_writers">
                                 <i class="metismenu-icon"></i> Approved Writers
                             </a>
                         </li>
                         <li>
                             <a href="/suspended_writers">
                                 <i class="metismenu-icon">
                                 </i>Suspended Writers
                             </a>
                         </li>
                         <li>
                             <a href="/writers">
                                 <i class="metismenu-icon">
                                 </i>All
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li>
                     <a href="/clients">
                         <i class="metismenu-icon pe-7s-display2"></i>
                         Clients
                     </a>
                 </li>
                 <li>
                     <a href="#">
                         <i class="metismenu-icon pe-7s-diamond "></i>
                         Add Job
                         <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                     </a>
                     <ul>
                         @foreach($sections as $section)
                         <li>
                             <a href="/addjob/{{$section->url}}">
                                 <i class="metismenu-icon"></i> {{$section->title}}
                             </a>
                         </li>
                         @endforeach
                     </ul>
                 </li>
                 <li>
                     <a href="#">
                         <i class="metismenu-icon pe-7s-diamond "></i>
                         My Jobs
                         <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                     </a>
                     <ul>
                         <li>
                             <a href="/submitted_projects?myjobs=true">
                                 <i class="metismenu-icon"></i> Submitted
                             </a>
                         </li>
                         <li>
                             <a href="/completed_projects?myjobs=true">
                                 <i class="metismenu-icon">
                                 </i>Completed
                             </a>
                         </li>
                         <li>
                             <a href="/unassigned_projects?myjobs=true">
                                 <i class="metismenu-icon">
                                 </i>Unassigned
                             </a>
                         </li>
                         <li>
                             <a href="/ongoing_projects?myjobs=true">
                                 <i class="metismenu-icon">
                                 </i>Ongoing
                             </a>
                         </li>

                     </ul>
                 </li>
                 <li>
                     <a href="#">
                         <i class="metismenu-icon pe-7s-diamond "></i>
                         Withdrawal
                         <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                     </a>
                     <ul>
                         <li>
                             <a href="/submitted_withdrawal"> 
                                 <i class="metismenu-icon"></i> Submitted
                             </a>
                         </li>
                         <li>
                             <a href="/completed_withdrawal">
                                 <i class="metismenu-icon">
                                 </i>Completed
                             </a>
                         </li>

                     </ul>
                 </li>
                 @else
                 <li>
                     <a href="/current">
                         <i class="metismenu-icon pe-7s-display2"></i>
                         Current Job
                     </a>
                 </li>
                 <li>
                     <a href="/pastjobs">
                         <i class="metismenu-icon pe-7s-display2"></i>
                         Past Jobs
                     </a>
                 </li>
                 @endif
                 <li>
                     <a href="#">
                         <i class="metismenu-icon pe-7s-diamond "></i>
                         My Account
                         <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                     </a>
                     <ul>
                         <li>
                             <a href="/profile">
                                 <i class="metismenu-icon"></i> View Profile
                             </a>
                         </li>
                         <li>
                             <a href="/edit_profile">
                                 <i class="metismenu-icon">
                                 </i>Edit Profile
                             </a>
                         </li>
                         <li>
                             <a href="/change_password">
                                 <i class="metismenu-icon">
                                 </i>Change Password
                             </a>
                         </li>
                         @if(Auth::User()->role == 'writer')
                         <li>
                             <a href="/account_details">
                                 <i class="metismenu-icon">
                                 </i>@if(Auth::User()->account_number == null)
                                        Add @else Edit @endif Account details
                             </a>
                         </li>
                         @endif
                     </ul>
                 </li>
                 <!-- <li>
                     <a href="forms-controls.html">
                         <i class="metismenu-icon pe-7s-mouse">
                         </i>Forms Controls
                     </a>
                 </li>
                 <li>
                     <a href="forms-layouts.html">
                         <i class="metismenu-icon pe-7s-eyedropper">
                         </i>Forms Layouts
                     </a>
                 </li>
                 <li>
                     <a href="forms-validation.html">
                         <i class="metismenu-icon pe-7s-pendrive">
                         </i>Forms Validation
                     </a>
                 </li>
                 <li>
                     <a href="charts-chartjs.html">
                         <i class="metismenu-icon pe-7s-graph2">
                         </i>ChartJS
                     </a>
                 </li> -->
             </ul>
         </div>
     </div>
 </div>
 <!-- end sidebar -->