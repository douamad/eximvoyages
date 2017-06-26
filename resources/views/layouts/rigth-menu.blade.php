<div class="fixed-sidebar-right">
    <ul class="right-sidebar nicescroll-bar">
        <li>
            <div  class="tab-struct custom-tab-1">
                <ul role="tablist" class="nav nav-tabs" id="right_sidebar_tab">
                    <li class="active" role="presentation"><a aria-expanded="true"  data-toggle="tab" role="tab" id="chat_tab_btn" href="#chat_tab">chat</a></li>
                    <li role="presentation" class=""><a  data-toggle="tab" id="messages_tab_btn" role="tab" href="#messages_tab" aria-expanded="false">messages</a></li>
                    <li role="presentation" class=""><a  data-toggle="tab" id="todo_tab_btn" role="tab" href="#todo_tab" aria-expanded="false">todo</a></li>
                </ul>
                <div class="tab-content" id="right_sidebar_content">
                    <div  id="chat_tab" class="tab-pane fade active in" role="tabpanel">
                        <div class="chat-box-wrap">
                            <form role="search">
                                <div class="input-group mb-15">
                                    <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Search">
                                    <span class="input-group-btn">
                                                    <button type="button" class="btn  btn-default"><i class="fa fa-search"></i></button>
                                                    </span>
                                </div>
                            </form>
                            <ul class="chat-list-wrap">
                                <li class="chat-list">
                                    <div class="chat-body">
                                        <a  href="javascript:void(0)">
                                            <div class="chat-data">
                                                <img class="user-img img-circle"  src="{{ asset('img/user.png') }}" alt="user"/>
                                                <div class="user-data">
                                                    <span class="name block capitalize-font">ryan gosling</span>
                                                    <span class="time block txt-grey">2pm</span>
                                                </div>
                                                <div class="status away"></div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                        <a  href="javascript:void(0)">
                                            <div class="chat-data">
                                                <img class="user-img img-circle"  src="{{ asset('img/user1.png') }}" alt="user"/>
                                                <div class="user-data">
                                                    <span class="name block capitalize-font">ryan gosling</span>
                                                    <span class="time block txt-grey">1pm</span>
                                                </div>
                                                <div class="status offline"></div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                        <a  href="javascript:void(0)">
                                            <div class="chat-data">
                                                <img class="user-img img-circle"  src="{{ asset('img/user2.png') }}" alt="user"/>
                                                <div class="user-data">
                                                    <span class="name block capitalize-font">ryan gosling</span>
                                                    <span class="time block txt-grey">2pm</span>
                                                </div>
                                                <div class="status online"></div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                        <a  href="javascript:void(0)">
                                            <div class="chat-data">
                                                <img class="user-img img-circle"  src="{{ asset('img/user3.png') }}" alt="user"/>
                                                <div class="user-data">
                                                    <span class="name block capitalize-font">ryan gosling</span>
                                                    <span class="time block txt-grey">2pm</span>
                                                </div>
                                                <div class="status online"></div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                        <a  href="javascript:void(0)">
                                            <div class="chat-data">
                                                <img class="user-img img-circle"  src="{{ asset('img/user4.png') }}" alt="user"/>
                                                <div class="user-data">
                                                    <span class="name block capitalize-font">ryan gosling</span>
                                                    <span class="time block txt-grey">2pm</span>
                                                </div>
                                                <div class="status online"></div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="messages_tab" class="tab-pane fade" role="tabpanel">
                        <div class="message-box-wrap">
                            <div class="streamline message-box">
                                <div class="sl-item">
                                    <div class="sl-avatar avatar avatar-sm avatar-circle">
                                        <img class="img-responsive img-circle" src="{{ asset('img/user.png') }}" alt="avatar"/>
                                    </div>
                                    <div class="sl-content">
                                        <a href="javascript:void(0)" class="inline-block capitalize-font  mb-5 pull-left">Sandy Doe</a>
                                        <span class="inline-block font-12 mb-5 pull-right">12/10/16</span>
                                        <div class="clearfix"></div>
                                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
                                    </div>
                                </div>
                                <hr/>
                                <div class="sl-item">
                                    <div class="sl-avatar avatar avatar-sm avatar-circle">
                                        <img class="img-responsive img-circle" src="{{ asset('img/user1.png') }}" alt="avatar"/>
                                    </div>
                                    <div class="sl-content">
                                        <a href="javascript:void(0)" class="inline-block capitalize-font  mb-5 pull-left">Sandy Doe</a>
                                        <span class="inline-block font-12 mb-5 pull-right">2pm</span>
                                        <div class="clearfix"></div>
                                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
                                    </div>
                                </div>
                                <hr/>
                                <div class="sl-item">
                                    <div class="sl-avatar avatar avatar-sm avatar-circle">
                                        <img class="img-responsive img-circle" src="{{ asset('img/user2.png') }} " alt="avatar"/>
                                    </div>
                                    <div class="sl-content">
                                        <a href="javascript:void(0)" class="inline-block capitalize-font  mb-5 pull-left">Sandy Doe</a>
                                        <span class="inline-block font-12 mb-5 pull-right">1pm</span>
                                        <div class="clearfix"></div>
                                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
                                    </div>
                                </div>
                                <hr/>
                                <div class="sl-item">
                                    <div class="sl-avatar avatar avatar-sm avatar-circle">
                                        <img class="img-responsive img-circle" src="{{ asset('img/user3.png') }} " alt="avatar"/>
                                    </div>
                                    <div class="sl-content">
                                        <a href="javascript:void(0)" class="inline-block capitalize-font  mb-5 pull-left">Sandy Doe</a>
                                        <span class="inline-block font-12 mb-5 pull-right">1pm</span>
                                        <div class="clearfix"></div>
                                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
                                    </div>
                                </div>
                                <hr/>
                                <div class="sl-item">
                                    <div class="sl-avatar avatar avatar-sm avatar-circle">
                                        <img class="img-responsive img-circle" src="{{ asset('img/user4.png') }}" alt="avatar"/>
                                    </div>
                                    <div class="sl-content">
                                        <a href="javascript:void(0)" class="inline-block capitalize-font  mb-5 pull-left">Sandy Doe</a>
                                        <span class="inline-block font-12 mb-5 pull-right">1pm</span>
                                        <div class="clearfix"></div>
                                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  id="todo_tab" class="tab-pane fade" role="tabpanel">
                        <div class="todo-box-wrap">
                            <!-- Todo-List -->
                            <ul class="todo-list">
                                <li class="todo-item">
                                    <div class="checkbox checkbox-default">
                                        <input type="checkbox" id="checkbox01"/>
                                        <label for="checkbox01">Record The First Episode Of HTML Tutorial</label>
                                    </div>
                                </li>
                                <li class="todo-item">
                                    <div class="checkbox checkbox-pink">
                                        <input type="checkbox" id="checkbox02"/>
                                        <label for="checkbox02">Prepare The Conference Schedule</label>
                                    </div>
                                </li>
                                <li class="todo-item">
                                    <div class="checkbox checkbox-warning">
                                        <input type="checkbox" id="checkbox03" checked/>
                                        <label for="checkbox03">Decide The Live Discussion Time</label>
                                    </div>
                                </li>
                                <li class="todo-item">
                                    <div class="checkbox checkbox-success">
                                        <input type="checkbox" id="checkbox04" checked/>
                                        <label for="checkbox04">Prepare For The Next Project</label>
                                    </div>
                                </li>
                                <li class="todo-item">
                                    <div class="checkbox checkbox-danger">
                                        <input type="checkbox" id="checkbox05" checked/>
                                        <label for="checkbox05">Finish Up AngularJs Tutorial</label>
                                    </div>
                                </li>
                                <li class="todo-item">
                                    <div class="checkbox checkbox-purple">
                                        <input type="checkbox" id="checkbox06" checked/>
                                        <label for="checkbox06">Finish Infinity Project</label>
                                    </div>
                                </li>
                            </ul>
                            <!-- /Todo-List -->
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
