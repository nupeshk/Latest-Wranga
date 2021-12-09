<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">
    <div class="media user-profile mt-2 mb-2">
        

        
        <?php if($this->session->userdata('logged_in')['photo']){?>
            <img src="<?=SITE_URL?>/assets/photo/<?=$this->session->userdata('logged_in')['photo']?>" class="avatar-sm rounded-circle mr-2"/>
        <?php }else{ ?>
            <img src="<?=SITE_URL?>/public/assets/images/users/avatar-7.jpg" class="avatar-sm rounded-circle mr-2"/>
        <?php } ?>






        <div class="media-body">
            <h6 class="pro-user-name mt-0 mb-0">
                <?php if(isset($this->session->userdata('logged_in')['SuperAdmin'])){
                        echo $this->session->userdata('logged_in')['name'];
               }elseif(isset($this->session->userdata('logged_in')['Admin'])){
                        echo $this->session->userdata('logged_in')['name'];
               }elseif(isset($this->session->userdata('logged_in')['teamLeader'])){
                        echo $this->session->userdata('logged_in')['name'];
               }elseif(isset($this->session->userdata('logged_in')['Reviewer'])) {
                        echo $this->session->userdata('logged_in')['name'];
               } ?> 
            </h6>
            <span class="pro-user-desc"></span> 

               <?php if(isset($this->session->userdata('logged_in')['SuperAdmin'])){
                        echo "Super Administrator";
               }elseif(isset($this->session->userdata('logged_in')['Admin'])){
                    echo "Admin";
               }elseif(isset($this->session->userdata('logged_in')['teamLeader'])){
                    echo "Team Leader";
               }elseif(isset($this->session->userdata('logged_in')['Reviewer'])) {
                    echo "Reviewer";
               } ?> 

        </div>
        <div class="dropdown align-self-center profile-dropdown-menu">
            <a class="dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <span data-feather="chevron-down"></span> 
            </a>
            <div class="dropdown-menu profile-dropdown">
                <a href="pages-profile.html" class="dropdown-item notify-item">
                    <i data-feather="user" class="icon-dual icon-xs mr-2"></i>
                    <span>My Account</span> 
                </a>
                <div class="dropdown-divider"></div>

                <a href="<?=SITE_URL?>/index.php/demo/superAdmin/logout" class="dropdown-item notify-item">
                    <i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
                    <span>Logout</span> 
                </a>
            </div>
        </div>
    </div>
    <div class="sidebar-content">
        <!--- Sidemenu -->
        <div id="sidebar-menu" class="slimscroll-menu">
            <ul class="metismenu" id="menu-bar">
                <li class="menu-title">Navigation</li>

                <li>
                    <a href="<?=SITE_URL?>/index.php/demo/dashboard.html">
                        <i data-feather="home"></i>
                        <span> Dashboard </span> 
                    </a>
                </li>
                <li class="menu-title">Content Management</li>

                <!--<li>
                                <a href="super-admin.html">
                                    <i data-feather="user"></i>
                                    <span class="badge badge-success float-right">1</span>
                                    <span> Super Admin </span>
                                </a>
                            </li>-->



                <li>
                    <a href="javascript: void(0);">
                        <i data-feather="airplay"></i>
                        <span>OTT</span>
                        <span class="menu-arrow"></span> 
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
      <li><a href="published-OTTs.html">Published OTTs</a></li><li>

                            <a href="<?=SITE_URL?>/index.php/demo/pending-OTTs.html">Pending OTTs</a> 
                        </li>
                        <li>

                            <a href="<?=SITE_URL?>/index.php/demo/upload-new-OTT.html">Upload New OTT <span class="menu-arrow"></span></a> 
                            <ul class="nav-third-level" aria-expanded="false">
                 <li><a href="http://wranga.in/index.php/demo/uploadOttgenralInfo.html">Genral Info</a></li>
                                            <li>
                                                <a href="http://wranga.in/index.php/demo/uploadOttRating.html">Rating</a>
                                            </li>
                                            <li>
                                                <a href="http://wranga.in/index.php/demo/uploadOttReview.html">Short Review</a>
                                            </li>
                                        </ul>
                        </li>
                    </ul>
                </li>



                <li>
                    <a href="javascript: void(0);">
                        <i data-feather="tablet"></i>
                        <span>Game</span>
                        <span class="menu-arrow"></span> 
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?=SITE_URL?>/index.php/demo/gamePublished.html">Published</a></li>
                        <li><a href="<?=SITE_URL?>/index.php/demo/gamePending.html">Pending</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i data-feather="package"></i>
                        <span>App</span>
                        <span class="menu-arrow"></span> 
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li>

                            <a href="<?=SITE_URL?>/index.php/demo/appPublished.html">Published</a> 
                        </li>
                        <li>

                            <a href="<?=SITE_URL?>/index.php/demo/appPending.html">Pending</a> 
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i data-feather="book-open"></i>
                        <span>Book</span>
                        <span class="menu-arrow"></span> 
                    </a>

                    <ul class="nav-second-level" aria-expanded="false">
                        <li>

                            <a href="<?=SITE_URL?>/index.php/demo/bookPublished.html">Published</a> 
                        </li>
                        <li>

                            <a href="<?=SITE_URL?>/index.php/demo/bookPending.html">Pending</a> 
                        </li>
                    </ul>
                </li>




     
                <li class="menu-title">User Management</li>

             <?php if(isset($this->session->userdata('logged_in')['Admin'])) {?>
                <style>.none{display:none}</style>
             <?php }?>
               
               <?php if(!isset($this->session->userdata('logged_in')['teamLeader'])) {?>

                <li class="none">
                    <a href="<?=SITE_URL?>/index.php/demo/admin.html">
                        <i data-feather="users"></i>
                        <span class="badge badge-success float-right"><?=$adminCount?></span>
                        <span> Admin </span> 
                    </a>
                </li>
<?php } ?>





               <?php if(!isset($this->session->userdata('logged_in')['teamLeader'])) {?>
                 <li>
                    <a href="<?=SITE_URL?>/index.php/demo/team-leader.html">
                        <i data-feather="users"></i>
                        <span class="badge badge-success float-right"><?=$teamLeaderCount?></span>
                        <span> Team Leader/s  </span> 
                    </a>
                </li>
            <?php } ?>


             <?php if(!isset($this->session->userdata('logged_in')['Reviewer'])) {?>      
                  <li><a href="<?=SITE_URL?>/index.php/demo/reviewer.html"><i data-feather="users"></i>
                        <span class="badge badge-success float-right"><?=$reviewerCount?></span>
                        <span> Reviewer/s  </span> 
                    </a>
                </li>
            <?php } ?>
            
    <?php if(!isset($this->session->userdata('logged_in')['Admin']) || !isset($this->session->userdata('logged_in')['SuperAdmin']) ) {?>      
                <li><a href="<?=SITE_URL?>/index.php/demo/mobileusersList"><i data-feather="smartphone"></i><span class="badge badge-success float-right"><?=$mobileCount?></span><span> Mobile users </span></a></li>
             <?php } ?>



                <li class="menu-title">Settings</li>
                            <li>
                                <a href="catagories.html">
                                    <i data-feather="toggle-right"></i>
                                    <span> Catagories</span>                                     </a>                                    </li>
                                    <li>
                                <a href="platform.html">
                                    <i data-feather="trello"></i>
                                    <span> Platform</span>                                     </a>                                    </li>
                                    <li>
                                <a href="language.html">
                                    <i data-feather="type"></i>
                                    <span> Language</span>                                     </a>                                    </li>
                                    <li>
                                <a href="OTT-content-type.html">
                                    <i data-feather="airplay"></i>
                                    <span> OTT Content Type</span>                                     </a>                                    </li>
                                    <li>
                                <a href="content-type.html">
                                    <i data-feather="slack"></i>
                                    <span>Content Type</span>                                     </a>                                    </li>
                                    <li>
                                <a href="genre.html">
                                    <i data-feather="music"></i>
                                    <span>Genre</span>                                     </a>                                    </li>



            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->