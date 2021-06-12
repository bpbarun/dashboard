<style>
    .vl {
        border-left: 6px solid green;
        height: 50px;
        margin: 19px;
    }
</style>
<?php
if (!empty($allCounters)) {
    $allCounters = json_decode($allCounters);
    $allCounters = (!empty($allCounters->data)) ? $allCounters->data : [];
    $html = '';
    $newArray = array();
    $arrayKey = array();
    if (!empty($allCounters)) {
        for ($i = 0; $i < COUNT($allCounters); $i++) {
            if (!empty($arrayKey)) {
                if (in_array($allCounters[$i]->counter_id, $arrayKey)) {

                    $newArray[$allCounters[$i]->counter_name][$i]['name'] = $allCounters[$i]->subcounter_name;
                    $newArray[$allCounters[$i]->counter_name][$i]['id'] = $allCounters[$i]->subcounter_id;
                } else {
                    $newArray[$allCounters[$i]->counter_name][$i]['name'] = $allCounters[$i]->subcounter_name;
                    $newArray[$allCounters[$i]->counter_name][$i]['id'] = $allCounters[$i]->subcounter_id;
                }
            } else {
                $newArray[$allCounters[$i]->counter_name][$i]['name'] = $allCounters[$i]->subcounter_name;
                $newArray[$allCounters[$i]->counter_name][$i]['id'] = $allCounters[$i]->subcounter_id;
            }
            array_push($arrayKey, $allCounters[$i]->counter_id);
        }
    }
    if (!empty($arrayKey)) {
        foreach ($newArray as $key => $subCounterData) {
            $html .= '<div class = "row">';
            $html .= '<div class = "col-sm-3">';
            $html .= '<h3>';
//            $html .= $key;
            $html .= "<button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle margin-right-10 btn-primary' value = '" . $key . "' disabled>";
            $html .= $key;
            $html .= "</button>";
            $html .= '</h3>';
            $html .= '</div>';
//            $html .= '<div class="vl"></div>';
            foreach ($subCounterData as $data) {
                $id = $data['id'];
                $name = '"' . $data['name'] . '"';

//            $html .= "<input type ='button' class='button button4' value = '" . $data['name'] . "' onclick ='PrintElem($id,$name)' />";
                $html .= "<button  class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default margin-right-10 margin-top-20' value = '" . $data['name'] . "' onclick ='PrintElem($id,$name)'>";
//                $html .= "<button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle margin-right-10 btn-info' value = '" . $data['name'] . "' onclick ='PrintElem($id,$name)'>";
                $html .= $data['name'];
                $html .= "</button>";
            }
            $html .= '</div>';
        }
    }
}

/* * ************************************************** */
?>
<div class="page-container">
    <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line">
                        <div class="tab-content">
                            <div class="tab-pane active fontawesome-demo" id="tab1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-box">
                                            <div class="card-head">
                                                <header>Print Token</header>
                                                <div class="tools">

                                                </div>
                                            </div>

                                            <div class="card-body ">
                                                <?php echo $html; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-------------Modal popup data----------------->
            <div class="modal" tabindex="-1" role="dialog" id="exampleModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <div class="card-head">
                                            <header>Material Form</header>
                                        </div>
                                        <div class="card-body row">
                                            <div class="col-lg-4 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input" type="text" id="text1">
                                                    <label class="mdl-textfield__label" for="text1">Simple Text Field</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="text2">
                                                    <label class="mdl-textfield__label" for="text2">
                                                        Number Text Field</label>
                                                    <span class="mdl-textfield__error">Number required!</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield">
                                                    <input class="mdl-textfield__input" type="text" id="text3" disabled>
                                                    <label class="mdl-textfield__label" for="text3">
                                                        Disabled Text Field</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                                    <input class="mdl-textfield__input" type="text" id="text4">
                                                    <label class="mdl-textfield__label" for="text4">Simple Text Field with Floating Label</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-width">
                                                    <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="text5">
                                                    <label class="mdl-textfield__label" for="text5">
                                                        Numeric Text Field with Floating Label</label>
                                                    <span class="mdl-textfield__error">Number required!</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield txt-width">
                                                    <textarea class="mdl-textfield__input" rows="3" id="text7"></textarea>
                                                    <label class="mdl-textfield__label" for="text7">Multiline Text Field</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable ">
                                                    <label class="mdl-button mdl-js-button mdl-button--icon" for="text8">
                                                        <i class="material-icons">search</i>
                                                    </label>
                                                    <div class="mdl-textfield__expandable-holder">
                                                        <input class="mdl-textfield__input " type="text" id="text8">
                                                        <label class="mdl-textfield__label" for="text8">
                                                            Expandable Input</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height select-width">
                                                    <input class="mdl-textfield__input" type="text" id="sample2" value="India" readonly tabIndex="-1">
                                                    <label for="sample2" class="pull-right margin-0">
                                                        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                                                    </label>
                                                    <label for="sample2" class="mdl-textfield__label">Country</label>
                                                    <ul data-mdl-for="sample2" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                                        <li class="mdl-menu__item" data-val="DE">Shrilanka</li>
                                                        <li class="mdl-menu__item" data-val="BY">India</li>
                                                        <li class="mdl-menu__item" data-val="RU">Germany</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 p-t-20">
                                                <input type="text" id="date" class="floating-label mdl-textfield__input" placeholder="Birth Date">
                                            </div>
                                            <div class="col-lg-12 p-t-20">
                                                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
                                                    <input type="checkbox" id="checkbox-1" class="mdl-checkbox__input" checked>
                                                    <span class="mdl-checkbox__label">Are you sure?</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-2 p-t-20">
                                                <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
                                                    <input type="radio" id="option-1" class="mdl-radio__button" name="options" value="1" checked>
                                                    <span class="mdl-radio__label">First</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-2 p-t-20">
                                                <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
                                                    <input type="radio" id="option-2" class="mdl-radio__button" name="options" value="2">
                                                    <span class="mdl-radio__label">Second</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-8 p-t-20">
                                            </div>
                                            <div class="col-lg-12 p-t-20">
                                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-8">
                                                    <input type="checkbox" id="switch-8" class="mdl-switch__input" checked>
                                                    <span class="mdl-switch__label">Off/On</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-12 p-t-20">
                                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                                    Button
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
            <!----------------------------------------------------------------------------------------------------------->
        </div>
    </div>
    <!-- end page content -->
    <!-- start chat sidebar -->
    <div class="chat-sidebar-container" data-close-on-body-click="false">
        <div class="chat-sidebar">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#quick_sidebar_tab_1" class="nav-link active tab-icon" data-toggle="tab"> <i class="material-icons">chat</i>Chat
                        <span class="badge badge-danger">4</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#quick_sidebar_tab_3" class="nav-link tab-icon" data-toggle="tab"> <i class="material-icons">settings</i>
                        Settings
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <!-- Start User Chat -->
                <div class="tab-pane active chat-sidebar-chat in active show" role="tabpanel" id="quick_sidebar_tab_1">
                    <div class="chat-sidebar-list">
                        <div class="chat-sidebar-chat-users slimscroll-style" data-rail-color="#ddd" data-wrapper-class="chat-sidebar-list">
                            <div class="chat-header">
                                <h5 class="list-heading">Online</h5>
                            </div>
                            <ul class="media-list list-items">
                                <li class="media"><img class="media-object" src="../assets/img/prof/prof3.jpg" width="35" height="35" alt="...">
                                    <i class="online dot"></i>
                                    <div class="media-body">
                                        <h5 class="media-heading">John Deo</h5>
                                        <div class="media-heading-sub">Spine Surgeon</div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-status">
                                        <span class="badge badge-success">5</span>
                                    </div> <img class="media-object" src="../assets/img/prof/prof1.jpg" width="35" height="35" alt="...">
                                    <i class="busy dot"></i>
                                    <div class="media-body">
                                        <h5 class="media-heading">Rajesh</h5>
                                        <div class="media-heading-sub">Director</div>
                                    </div>
                                </li>
                                <li class="media"><img class="media-object" src="../assets/img/prof/prof5.jpg" width="35" height="35" alt="...">
                                    <i class="away dot"></i>
                                    <div class="media-body">
                                        <h5 class="media-heading">Jacob Ryan</h5>
                                        <div class="media-heading-sub">Ortho Surgeon</div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-status">
                                        <span class="badge badge-danger">8</span>
                                    </div> <img class="media-object" src="../assets/img/prof/prof4.jpg" width="35" height="35" alt="...">
                                    <i class="online dot"></i>
                                    <div class="media-body">
                                        <h5 class="media-heading">Kehn Anderson</h5>
                                        <div class="media-heading-sub">CEO</div>
                                    </div>
                                </li>
                                <li class="media"><img class="media-object" src="../assets/img/prof/prof2.jpg" width="35" height="35" alt="...">
                                    <i class="busy dot"></i>
                                    <div class="media-body">
                                        <h5 class="media-heading">Sarah Smith</h5>
                                        <div class="media-heading-sub">Computer</div>
                                    </div>
                                </li>
                                <li class="media"><img class="media-object" src="../assets/img/prof/prof7.jpg" width="35" height="35" alt="...">
                                    <i class="online dot"></i>
                                    <div class="media-body">
                                        <h5 class="media-heading">Vlad Cardella</h5>
                                        <div class="media-heading-sub">Cardiologist</div>
                                    </div>
                                </li>
                            </ul>
                            <div class="chat-header">
                                <h5 class="list-heading">Offline</h5>
                            </div>
                            <ul class="media-list list-items">
                                <li class="media">
                                    <div class="media-status">
                                        <span class="badge badge-warning">4</span>
                                    </div> <img class="media-object" src="../assets/img/prof/prof6.jpg" width="35" height="35" alt="...">
                                    <i class="offline dot"></i>
                                    <div class="media-body">
                                        <h5 class="media-heading">Jennifer Maklen</h5>
                                        <div class="media-heading-sub">Nurse</div>
                                        <div class="media-heading-small">Last seen 01:20 AM</div>
                                    </div>
                                </li>
                                <li class="media"><img class="media-object" src="../assets/img/prof/prof8.jpg" width="35" height="35" alt="...">
                                    <i class="offline dot"></i>
                                    <div class="media-body">
                                        <h5 class="media-heading">Lina Smith</h5>
                                        <div class="media-heading-sub">Ortho Surgeon</div>
                                        <div class="media-heading-small">Last seen 11:14 PM</div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-status">
                                        <span class="badge badge-success">9</span>
                                    </div> <img class="media-object" src="../assets/img/prof/prof9.jpg" width="35" height="35" alt="...">
                                    <i class="offline dot"></i>
                                    <div class="media-body">
                                        <h5 class="media-heading">Jeff Adam</h5>
                                        <div class="media-heading-sub">Compounder</div>
                                        <div class="media-heading-small">Last seen 3:31 PM</div>
                                    </div>
                                </li>
                                <li class="media"><img class="media-object" src="../assets/img/prof/prof10.jpg" width="35" height="35" alt="...">
                                    <i class="offline dot"></i>
                                    <div class="media-body">
                                        <h5 class="media-heading">Anjelina Cardella</h5>
                                        <div class="media-heading-sub">Physiotherapist</div>
                                        <div class="media-heading-small">Last seen 7:45 PM</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="chat-sidebar-item">
                        <div class="chat-sidebar-chat-user">
                            <div class="page-quick-sidemenu">
                                <a href="javascript:;" class="chat-sidebar-back-to-list">
                                    <i class="fa fa-angle-double-left"></i>Back
                                </a>
                            </div>
                            <div class="chat-sidebar-chat-user-messages">
                                <div class="post out">
                                    <img class="avatar" alt="" src="../assets/img/dp.jpg" />
                                    <div class="message">
                                        <span class="arrow"></span> <a href="javascript:;" class="name">Kiran Patel</a> <span class="datetime">9:10</span>
                                        <span class="body-out"> could you send me menu icons ? </span>
                                    </div>
                                </div>
                                <div class="post in">
                                    <img class="avatar" alt="" src="../assets/img/prof/prof5.jpg" />
                                    <div class="message">
                                        <span class="arrow"></span> <a href="javascript:;" class="name">Jacob Ryan</a> <span class="datetime">9:10</span>
                                        <span class="body"> please give me 10 minutes. </span>
                                    </div>
                                </div>
                                <div class="post out">
                                    <img class="avatar" alt="" src="../assets/img/dp.jpg" />
                                    <div class="message">
                                        <span class="arrow"></span> <a href="javascript:;" class="name">Kiran Patel</a> <span class="datetime">9:11</span>
                                        <span class="body-out"> ok fine :) </span>
                                    </div>
                                </div>
                                <div class="post in">
                                    <img class="avatar" alt="" src="../assets/img/prof/prof5.jpg" />
                                    <div class="message">
                                        <span class="arrow"></span> <a href="javascript:;" class="name">Jacob Ryan</a> <span class="datetime">9:22</span>
                                        <span class="body">Sorry for
                                            the delay. i sent mail to you. let me know if it is ok or not.</span>
                                    </div>
                                </div>
                                <div class="post out">
                                    <img class="avatar" alt="" src="../assets/img/dp.jpg" />
                                    <div class="message">
                                        <span class="arrow"></span> <a href="javascript:;" class="name">Kiran Patel</a> <span class="datetime">9:26</span>
                                        <span class="body-out"> it is perfect! :) </span>
                                    </div>
                                </div>
                                <div class="post out">
                                    <img class="avatar" alt="" src="../assets/img/dp.jpg" />
                                    <div class="message">
                                        <span class="arrow"></span> <a href="javascript:;" class="name">Kiran Patel</a> <span class="datetime">9:26</span>
                                        <span class="body-out"> Great! Thanks. </span>
                                    </div>
                                </div>
                                <div class="post in">
                                    <img class="avatar" alt="" src="../assets/img/prof/prof5.jpg" />
                                    <div class="message">
                                        <span class="arrow"></span> <a href="javascript:;" class="name">Jacob Ryan</a> <span class="datetime">9:27</span>
                                        <span class="body"> it is my pleasure :) </span>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-sidebar-chat-user-form">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Type a message here...">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn deepPink-bgcolor">
                                            <i class="fa fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End User Chat -->
                <!-- Start Setting Panel -->
                <div class="tab-pane chat-sidebar-settings" role="tabpanel" id="quick_sidebar_tab_3">
                    <div class="chat-sidebar-settings-list slimscroll-style">
                        <div class="chat-header">
                            <h5 class="list-heading">Layout Settings</h5>
                        </div>
                        <div class="chatpane inner-content ">
                            <div class="settings-list">
                                <div class="setting-item">
                                    <div class="setting-text">Sidebar Position</div>
                                    <div class="setting-set">
                                        <select class="sidebar-pos-option form-control input-inline input-sm input-small ">
                                            <option value="left" selected="selected">Left</option>
                                            <option value="right">Right</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-text">Header</div>
                                    <div class="setting-set">
                                        <select class="page-header-option form-control input-inline input-sm input-small ">
                                            <option value="fixed" selected="selected">Fixed</option>
                                            <option value="default">Default</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-text">Sidebar Menu </div>
                                    <div class="setting-set">
                                        <select class="sidebar-menu-option form-control input-inline input-sm input-small ">
                                            <option value="accordion" selected="selected">Accordion</option>
                                            <option value="hover">Hover</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-text">Footer</div>
                                    <div class="setting-set">
                                        <select class="page-footer-option form-control input-inline input-sm input-small ">
                                            <option value="fixed">Fixed</option>
                                            <option value="default" selected="selected">Default</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-header">
                                <h5 class="list-heading">Account Settings</h5>
                            </div>
                            <div class="settings-list">
                                <div class="setting-item">
                                    <div class="setting-text">Notifications</div>
                                    <div class="setting-set">
                                        <div class="switch">
                                            <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-1">
                                                <input type="checkbox" id="switch-1" class="mdl-switch__input" checked>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-text">Show Online</div>
                                    <div class="setting-set">
                                        <div class="switch">
                                            <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-7">
                                                <input type="checkbox" id="switch-7" class="mdl-switch__input" checked>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-text">Status</div>
                                    <div class="setting-set">
                                        <div class="switch">
                                            <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-2">
                                                <input type="checkbox" id="switch-2" class="mdl-switch__input" checked>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-text">2 Steps Verification</div>
                                    <div class="setting-set">
                                        <div class="switch">
                                            <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-3">
                                                <input type="checkbox" id="switch-3" class="mdl-switch__input" checked>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-header">
                                <h5 class="list-heading">General Settings</h5>
                            </div>
                            <div class="settings-list">
                                <div class="setting-item">
                                    <div class="setting-text">Location</div>
                                    <div class="setting-set">
                                        <div class="switch">
                                            <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-4">
                                                <input type="checkbox" id="switch-4" class="mdl-switch__input" checked>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-text">Save Histry</div>
                                    <div class="setting-set">
                                        <div class="switch">
                                            <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-5">
                                                <input type="checkbox" id="switch-5" class="mdl-switch__input" checked>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-text">Auto Updates</div>
                                    <div class="setting-set">
                                        <div class="switch">
                                            <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-6">
                                                <input type="checkbox" id="switch-6" class="mdl-switch__input" checked>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end chat sidebar -->
</div>
<!-- end page container -->
<script>
    function PrintElem(id, name)
    {
        console.log('called123');
        var $ajaxURLPart = "<?php echo base_url(); ?>";
        postedData = {};
        postedData['subcounter_id'] = id;
        postedData['is_active'] = 1;
        if ($('#counterID').val() !== '') {
            postedData['counter_id'] = $('#counterID').val();
        }
        $.ajax({
            url: $ajaxURLPart + 'token/addToken/',
            method: "POST",
            data: postedData,
            beforeSend: function () {
                // $('#' + $saveBtn).button('loading');
            }, complete: function () {
//                $('#' + $saveBtn).button('reset');
                //$('#ImgModal').modal('hide');
            }, success: function (response) {
                console.log('response data is =', response);
                console.log('after success statusis ==', response.status);
                let res = JSON.parse(response);
                if (res.status) {
                    console.log('your latest data is ==========', res.data.token_id);
                    var mywindow = window.open('', 'AIIMS HOSPITAL', 'height=400,width=600');
                    mywindow.document.write('<html><head><title>Please wait for you turn...</title>');
                    mywindow.document.write('AIIMS HOSPITAL RAIPUR CG,');
                    mywindow.document.write('<hr>');
                    mywindow.document.write(name + (res.data.token_id).bold());
                    mywindow.document.write("Token no : " + name + " <h2><b>" ' ' + (res.data.token_id).bold() + "</b></h2>");
                    mywindow.document.write('</body></html>');
                    mywindow.print();
                    mywindow.close();
                    return true;
                } else {
                    console.log('error in adding the conter');
                }
            }, error: function () {
                $('#' + $saveBtn).button('reset');
                // error/exception handling
                ajaxErrorHandling(jqXHR);
            }
        });
    }
</script>